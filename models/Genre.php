<?php

namespace app\models;


/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $name
 *
 * @property MovieGenre[] $movieGenres
 * @property Movie[] $movies
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[MovieGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieGenres()
    {
        return $this->hasMany(MovieGenre::class, ['genre_id' => 'id']);
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movie::class, ['id' => 'movie_id'])->viaTable('movie_genre', ['genre_id' => 'id']);
    }
}
