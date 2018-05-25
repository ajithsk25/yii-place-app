<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=>'place_id',
                'value' => $model->place->name,
                'widgetOptions'=>[
                    'data'=>\yii\helpers\ArrayHelper::map(\app\models\Place::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                ]
            ],
            [
                'attribute'=>'country_id',
                'value' => $model->country->name,
                'widgetOptions'=>[
                    'data'=>\yii\helpers\ArrayHelper::map(\app\models\Country::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                ]
            ],
        ],
    ]) ?>

</div>
