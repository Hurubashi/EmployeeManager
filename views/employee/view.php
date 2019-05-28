<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= !(Yii::$app->user->isGuest) ?
            Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>

        <?= !(Yii::$app->user->isGuest) ?
            Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : ''?>

        <?= !(Yii::$app->user->isGuest) ?
            Html::a('Create Task', ['task/create', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'position',
            'salary',
            'start',
            'end',
            'phone',
            'address',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description',
            'status',

	        Yii::$app->user->isGuest ?
		        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} ']
		        : ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
