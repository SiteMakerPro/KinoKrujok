<?php

namespace app\models;


/**
 * This is the model class for table "movie".
 *
 * @property int $id
 * @property string $title
 * @property string $year
 * @property float $rating
 * @property string $imgPath
 * @property string $miniImgPath
 * @property int $votesCountNumber
 *
 * @property Genre[] $genres
 * @property MovieGenre[] $movieGenres
 * @property UserMovie[] $userMovies
 * @property Vote[] $votes
 */
class Movie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'imgPath', 'miniImgPath', 'votesCountNumber'], 'required'],
            [['year'], 'safe'],
            [['rating'], 'number'],
            [['votesCountNumber'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['imgPath', 'miniImgPath'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'year' => 'Year',
            'rating' => 'Rating',
            'imgPath' => 'Img Path',
            'miniImgPath' => 'Mini Img Path',
            'votesCountNumber' => 'Votes Count Number',
        ];
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'genre_id'])->viaTable('movie_genre', ['movie_id' => 'id']);
    }

    /**
     * Gets query for [[MovieGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieGenres()
    {
        return $this->hasMany(MovieGenre::className(), ['movie_id' => 'id']);
    }

    /**
     * Gets query for [[UserMovies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserMovies()
    {
        return $this->hasMany(UserMovie::className(), ['idM' => 'id']);
    }

    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['movie_id' => 'id']);
    }
}
