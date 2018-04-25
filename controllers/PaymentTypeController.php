<?php

namespace tomaivanovtomov\order\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use tomaivanovtomov\order\models\PaymentType;
use tomaivanovtomov\order\models\PaymentTypeSearch;
use yii\filters\AccessControl;

/**
 * PaymentTypeController implements the CRUD actions for PaymentType model.
 */
class PaymentTypeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PaymentType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PaymentType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentType();

        if ($model->load(Yii::$app->request->post())) {

            $model->multilingualLoad($model, ['title']);

            $model->enable = Yii::$app->request->post('hidden-enable');

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id, true);

        if ($model->load(Yii::$app->request->post())) {

            $model->multilingualLoad($model, ['title']);

            $model->enable = Yii::$app->request->post('hidden-enable');

            if($model->update() !== false){
                Yii::$app->session->setFlash('success',  Yii::t('app', 'Your changes were saved successfully!'));
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error',  Yii::t('app', 'Something went wrong. Please, try again later!'));
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionChangeSwitch(){
        $id = Yii::$app->request->post('id');
        $model = PaymentType::findOne($id);
        if(!empty($model)){

            if($model->enable == 1){
                $model->enable = 2;
            }else{
                $model->enable = 1;
            }

            $model->update();
        }
    }

    public function actionSort()
    {
        $model = new PaymentType();

        if(Yii::$app->request->post()){

            $sort = 1;

            foreach (Yii::$app->request->post('Type') as $id){

                if( $model->reorderTypes($id, $sort) === false ){
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Something went wrong! Please, try again.'));
                    return $this->render('_sort', [
                        'result' => $model->loadTypes()
                    ]);
                }

                $sort++;

            }

            Yii::$app->session->setFlash('success', Yii::t('app', 'Order was updated successfully!'));

        }

        return $this->render('_sort', [
            'result' => $model->loadTypes()
        ]);
    }

    /**
     * Deletes an existing PaymentType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $multilingual = false)
    {
        if($multilingual === true){
            $model = PaymentType::find()->where(['id' => $id])->multilingual()->one();
        }else{
            $model = PaymentType::findOne($id);
        }

        if(!empty($model)){
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
