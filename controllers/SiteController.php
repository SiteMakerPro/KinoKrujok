<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Genre;
use app\models\Movie;
use app\models\SignupForm;
use app\models\User;
use app\models\Vote;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['auth', 'error', 'index', 'vote', 'history'],
                    'roles' => ['?', '@'],
                ],
                [
                    'allow' => true,
                    'actions' => ['logout', 'profile'],
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
                    'actions' => ['admin-panel'],
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->role === 'admin';
                    }
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                Yii::$app->session->setFlash('error', 'У вас нет прав для доступа к этой странице.');
                return Yii::$app->response->redirect(['site/index']);
            },
        ],
    ];
}

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
			$topMovie = Movie::find()
        ->with('genres')
        ->select(['movie.*', 'COUNT(vote.id) AS voteCount'])
        ->innerJoin('vote', 'vote.movie_id = movie.id')
        ->groupBy('movie.id')
        ->orderBy(['voteCount' => SORT_DESC, 'movie.id' => SORT_ASC])
        ->asArray()
        ->one();

				$totalVotes = (int) Vote::find()->count();
				$totalUsers = (int) User::find()->count();

				if (!$topMovie) {
						$topMovie = Movie::find()->with('genres')->asArray()->one();
						if ($topMovie) {
								$topMovie['voteCount'] = 0;
						}
				}
				$moodQuery = Movie::find()->with('genres')->limit(4);
    $moodDataProvider = new \yii\data\ActiveDataProvider([
        'query' => $moodQuery,
        'pagination' => false,
    ]);

    $historyQuery = Movie::find()
        ->innerJoin('user_movie', 'user_movie.idM = movie.id')
        ->select(['movie.*', 'user_movie.viewingDate'])
        ->where(['user_movie.idU' => 3]) 
        ->orderBy(['user_movie.viewingDate' => SORT_DESC])
        ->limit(6)
				->asArray();

    $historyDataProvider = new \yii\data\ActiveDataProvider([
        'query' => $historyQuery,
        'pagination' => false,
    ]);

    return $this->render('index', [
        'topMovie' => $topMovie,
        'totalVotes' => $totalVotes,
        'totalUsers' => $totalUsers,
        'moodDataProvider' => $moodDataProvider,
        'historyDataProvider' => $historyDataProvider,
    ]);

    }

		public function actionHistory()
		{
			$userId = 3;

			$query = Movie::find()
					->with('genres')
					->innerJoin('user_movie', 'user_movie.idM = movie.id')
					->where(['user_movie.idU' => $userId])
					->select(['movie.*', 'user_movie.viewingDate', 'user_movie.isLiked'])
					->asArray();
	
			$dataProvider = new \yii\data\ActiveDataProvider([
					'query' => $query,
					'pagination' => ['pageSize' => 8],
			]);
	
			return $this->render('history', [
					'dataProvider' => $dataProvider,
			]);
		}

		public function actionVote($genre_id = null)
		{
			$topMovies = Movie::find()
        ->select(['movie.*', 'COUNT(vote.id) AS voteCount']) 
        ->innerJoin('vote', 'vote.movie_id = movie.id')
        ->groupBy('movie.id')
        ->orderBy(['voteCount' => SORT_DESC])
        ->limit(3)
        ->asArray()
        ->all();
			$totalVotes = (int) \app\models\Vote::find()->count();

			$genres = Genre::find()->orderBy(['name' => SORT_ASC])->all();

			$query = Movie::find()
					->with('genres')
					->select(['movie.*'])
					->asArray();

			if ($genre_id) {
					$query->innerJoin('movie_genre', 'movie_genre.movie_id = movie.id')
								->where(['movie_genre.genre_id' => $genre_id])
								->distinct();
			}

			$dataProvider = new \yii\data\ActiveDataProvider([
					'query' => $query,
					'pagination' => [
							'pageSize' => 12,
					],
			]);

			return $this->render('vote', [
					'dataProvider' => $dataProvider,
					'genres' => $genres,
					'currentGenreId' => $genre_id,
					'topMovies' => $topMovies,
					'totalVotes' => $totalVotes
			]);
		}

		public function actionProfile()
		{
				if (Yii::$app->user->isGuest) {
						return $this->redirect(['site/auth']);
				}

				/** @var \app\models\User $user */
				$user = Yii::$app->user->identity;
				$userId = $user->id;

				if ($user->load(Yii::$app->request->post()) && $user->save()) {
						Yii::$app->session->setFlash('success', 'Настройки успешно сохранены!');
						return $this->refresh();
				}

				$totalMovies = \app\models\UserMovie::find()->where(['idU' => $userId])->count();
				
				$avgRating = (new \yii\db\Query())
						->from('user_movie')
						->innerJoin('movie', 'movie.id = user_movie.idM')
						->where(['user_movie.idU' => $userId])
						->average('movie.rating');
				$avgRating = $avgRating ? round($avgRating, 1) : 0;

				$totalVotes = \app\models\Vote::find()->where(['user_id' => $userId])->count();

				$recentActivity = \app\models\Movie::find()
						->innerJoin('user_movie', 'user_movie.idM = movie.id')
						->select(['movie.*', 'user_movie.viewingDate'])
						->where(['user_movie.idU' => $userId])
						->orderBy(['user_movie.viewingDate' => SORT_DESC])
						->limit(3)
						->asArray()
						->all();

				$favoriteGenres = (new \yii\db\Query())
						->select(['genre.name', 'COUNT(movie_genre.movie_id) AS genre_count'])
						->from('user_movie')
						->innerJoin('movie_genre', 'movie_genre.movie_id = user_movie.idM')
						->innerJoin('genre', 'genre.id = movie_genre.genre_id')
						->where(['user_movie.idU' => $userId])
						->groupBy('genre.id')
						->orderBy(['genre_count' => SORT_DESC])
						->limit(3)
						->all();

				$totalGenreCount = array_sum(array_column($favoriteGenres, 'genre_count'));
				foreach ($favoriteGenres as &$genre) {
						$genre['percent'] = $totalGenreCount > 0 ? round(($genre['genre_count'] / $totalGenreCount) * 100) : 0;
				}
				unset($genre);

				return $this->render('profile', [
						'user' => $user,
						'totalMovies' => $totalMovies,
						'avgRating' => $avgRating,
						'totalVotes' => $totalVotes,
						'recentActivity' => $recentActivity,
						'favoriteGenres' => $favoriteGenres,
				]);
		}
		public function actionAuth()
		{
				if (!Yii::$app->user->isGuest) {
						return $this->goHome();
				}

				$loginModel = new LoginForm();
				$signupModel = new SignupForm();

				if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
						return $this->goBack();
				}

				if ($signupModel->load(Yii::$app->request->post()) && $signupModel->signup()) {
						Yii::$app->session->setFlash('success', 'Вы успешно зарегистрированы! Теперь можете войти.');
						return $this->refresh();
				}

				return $this->render('auth', [
						'model' => $loginModel,
						'signupModel' => $signupModel,
				]);
		}

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
		public function actionAdminPanel()
		{
				$movies = \app\models\Movie::find()->orderBy(['id' => SORT_ASC])->all();
				
				$totalMovies = \app\models\Movie::find()->count();
				$totalVotes = \app\models\Vote::find()->count();

				return $this->render('adminPanel', [
						'movies' => $movies,
						'totalMovies' => $totalMovies,
						'totalVotes' => $totalVotes,
				]);
		}
		public function actionRegister()
		{
			return $this->render('register');
		}

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
