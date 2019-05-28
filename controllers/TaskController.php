<?php

namespace app\controllers;

use app\models\Employee;
use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class TaskController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($id)
    {
	    $this->checkRights();
        // Check if user exists
        if (($employee = Employee::findOne($id)) == null) {
            throw new NotFoundHttpException('You can not add task to non existent employee.');
        }
        // Add task to user with employee_id = $id
        $model = new Task();
        $model->employee_id = $employee->id;
        $model->employee_name = $employee->name;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['employee/view', 'id' => $model->employee_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
    	$this->checkRights();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
	    $this->checkRights();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function checkRights() {
	    if (Yii::$app->user->isGuest) {
		    throw new NotFoundHttpException('Not allowed.');
	    }
    }
}
