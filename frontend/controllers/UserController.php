<?php

namespace frontend\controllers;

use Yii;
use app\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN){
            $queryParams['UserSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJabatanUser::findOne(['id' => $model->jabatan_id]);
        $model->jabatan_id = $ref['desc'];
        
        $ref = RefStatusUser::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = UserPeranan::findOne(['user_peranan_id' => $model->peranan]);
        $model->peranan = $ref['nama_peranan'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan]);
        $model->profil_badan_sukan = $ref['nama_badan_sukan'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed delete()
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new User();
        
        $model->scenario = 'create';
        
        $model->status = \common\models\User::STATUS_ACTIVE;
        
        $model->last_active = GeneralFunction::getCurrentTimestamp();
        /*$model->peranan = 3;
        $model->jabatan_id = 4;
        $model->full_name = 'Admin ';
        $model->username = '8009010358';
        $model->new_password = 'Abcdef@123456';
        $model->password_confirm = 'Abcdef@123456';*/
        
        if ($model->load(Yii::$app->request->post())) {
            //$stringlens = strlen($model->sukan);
            if(is_array($model->sukan)){
                $model->sukan = implode(",",$model->sukan);
            } else {
                $model->sukan = "";
            }
            
            if(is_array($model->negeri)){
                $model->negeri = implode(",",$model->negeri);
            } else {
                $model->negeri = "";
            }
        }

        if (Yii::$app->request->post() && $model->validate()) {
            
            $model->setPassword($model->new_password);
            $model->generateAuthKey();
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing User model.
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
        
        if ($model->load(Yii::$app->request->post()) && $model->sukan) {
            //$stringlens = $model->sukan;
            if(is_array($model->sukan)){
                $model->sukan = implode(",",$model->sukan);
            } else {
                $model->sukan = "";
            }
        }
        
        if (Yii::$app->request->post() && $model->negeri) {
            //$stringlens = $model->negeri;
            if(is_array($model->negeri)){
                $model->negeri = implode(",",$model->negeri);
            } else {
                $model->negeri = "";
            }
        }

        if (Yii::$app->request->post() && $model->validate()) {
            //$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            if($model->new_password != ''){
                $model->setPassword($model->new_password);
                $model->login_attempted = 0; //reset login attempt
                $model->is_new_user = 'YES';
            }
            
            $model->last_active = GeneralFunction::getCurrentTimestamp(); // reset last_active date
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
