<?php

namespace app\models;


/**
 * This is the model class for table "user_movie".
 *
 * @property int $idUM
 * @property int $idU
 * @property int $idM
 * @property string $viewingDate
 * @property int $isLiked
 *
 * @property Movie $idM0
 * @property User $idU0
 */
class UserMovie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idU', 'idM', 'viewingDate', 'isLiked'], 'required'],
            [['idU', 'idM', 'isLiked'], 'integer'],
            [['viewingDate'], 'safe'],
            [['idM'], 'exist', 'skipOnError' => true, 'targetClass' => Movie::className(), 'targetAttribute' => ['idM' => 'id']],
            [['idU'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idU' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUM' => 'Id Um',
            'idU' => 'Id U',
            'idM' => 'Id M',
            'viewingDate' => 'Viewing Date',
            'isLiked' => 'Is Liked',
        ];
    }

    /**
     * Gets query for [[IdM0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdM0()
    {
        return $this->hasOne(Movie::class, ['id' => 'idM']);
    }

    /**
     * Gets query for [[IdU0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdU0()
    {
        return $this->hasOne(User::class, ['id' => 'idU']);
    }
}
