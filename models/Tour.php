<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property int $place_id
 *
 * @property Countries $country
 * @property Places $place
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country_id', 'place_id'], 'required'],
            [['country_id', 'place_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
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
            'country_id' => 'Country',
            'place_id' => 'Place',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return $this
     */
    public function tourSave()
    {
        $data = Yii::$app->request->post();

        $place = Place::find()->select('country_id')->where(['id' => $data['Tour']['place_id']])->one();

        $data['Tour']['country_id'] = $place->country_id;


        if ($this->load($data) && $this->validate() && $this->save()) {
            return $this;
        }
    }

    public function tourUpdate($id)
    {
        $model = $this->find()->where(['id' => $id])->one();

        $data = Yii::$app->request->post();

        $place = Place::find()->select('country_id')->where(['id' => $data['Tour']['place_id']])->one();

        $data['Tour']['country_id'] = $place->country_id;


        if ($model->load($data) && $model->validate() && $model->save()) {
            return $this;
        }
    }
}
