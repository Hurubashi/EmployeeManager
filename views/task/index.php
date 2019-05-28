<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'employee_name',
            'title',
            'description',
            'status',

	        Yii::$app->user->isGuest ?
		        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} ']
		        : ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
