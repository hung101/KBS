<?php

namespace frontend\controllers;

use Yii;
use app\models\UserPeranan;
use frontend\models\UserPerananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

use app\models\RefJabatanUser;
use app\models\RefBahagianUser;
use app\models\RefCawanganUser;

/**
 * UserPerananController implements the CRUD actions for UserPeranan model.
 */
class UserPerananController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserPeranan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user-peranan']['view_own_data'])){
            $queryParams['UserPerananSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        $searchModel = new UserPerananSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserPeranan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJabatanUser::findOne(['id' => $model->jabatan]);
        $model->jabatan = $ref['desc'];
        
        $ref = RefBahagianUser::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefCawanganUser::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $model->aktif = GeneralLabel::getYesNoLabel($model->aktif);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new UserPeranan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new UserPeranan();
        
        if($model->load(Yii::$app->request->post())){
            $msn = Yii::$app->request->post('MSN');
            
            $isn = Yii::$app->request->post('ISN');
            
            $pjs = Yii::$app->request->post('PJS');
            
            $kbs = Yii::$app->request->post('KBS');
            
            $admin = Yii::$app->request->post('Admin');
            
            $modules = null;
            
            if($msn){
                $modules['MSN'] = $msn;
            }
            
            if($isn){
                $modules['ISN'] = $isn;
            }
            
            if($pjs){
                $modules['PJS'] = $pjs;
            }
            
            if($kbs){
                $modules['KBS'] = $kbs;
            }
            
            if($admin){
                $modules['Admin'] = $admin;
            }
            
            if(isset($model->agensi)){
                $model->agensi = implode(",",$model->agensi);
            }
            
            if($modules != null){
            foreach($modules as $category_key => $category_value){
                foreach($category_value as $action_key => $action_value){
                    foreach($action_value as $permission_key => $permission_value){
                        $modules[$category_key][$action_key][$permission_value] = true;
                        unset($modules[$category_key][$action_key][$permission_key]);
                    }
                }
            }
            }
            
            // array to string to store into database
            $model->peranan_akses = json_encode($modules);
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_peranan_id]);
        } else {
            
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing UserPeranan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        if($model->load(Yii::$app->request->post())){
            $msn = Yii::$app->request->post('MSN');
            
            $isn = Yii::$app->request->post('ISN');
            
            $pjs = Yii::$app->request->post('PJS');
            
            $kbs = Yii::$app->request->post('KBS');
            
            $admin = Yii::$app->request->post('Admin');
            
            $modules = null;
            
            if($msn){
                $modules['MSN'] = $msn;
            }
            
            if($isn){
                $modules['ISN'] = $isn;
            }
            
            if($pjs){
                $modules['PJS'] = $pjs;
            }
            
            if($kbs){
                $modules['KBS'] = $kbs;
            }
            
            if($admin){
                $modules['Admin'] = $admin;
            }
            
            if(isset($model->agensi)){
                $model->agensi = implode(",",$model->agensi);
            }
            
            if($modules != null){
                foreach($modules as $category_key => $category_value){
                    foreach($category_value as $action_key => $action_value){
                        foreach($action_value as $permission_key => $permission_value){
                            $modules[$category_key][$action_key][$permission_value] = true;
                            unset($modules[$category_key][$action_key][$permission_key]);
                        }
                    }
                }
            }
            
            // array to string to store into database
            $model->peranan_akses = json_encode($modules);
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_peranan_id]);
        } else {
            if(isset($model->agensi)){
                $model->agensi = explode(",",$model->agensi);
            }
            
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing UserPeranan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserPeranan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserPeranan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserPeranan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
