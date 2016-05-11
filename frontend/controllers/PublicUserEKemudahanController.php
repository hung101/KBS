<?php

namespace frontend\controllers;

use Yii;
use app\models\PublicUserEKemudahan;
use frontend\models\PublicUserEKemudahanSearch;
use common\models\PublicUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

use app\models\RefStatusUser;
use app\models\RefKategoriHakmilik;
use app\models\RefJenisPenggunaEKemudahan;


/**
 * PublicUserEKemudahanController implements the CRUD actions for PublicUserEKemudahan model.
 */
class PublicUserEKemudahanController extends Controller
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
     * Lists all PublicUserEKemudahan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PublicUserEKemudahanSearch']['category_access'] = PublicUser::ACCESS_KEMUDAHAN;
        
        $searchModel = new PublicUserEKemudahanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PublicUserEKemudahan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefStatusUser::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefJenisPenggunaEKemudahan::findOne(['id' => $model->jenis_pengguna_e_kemudahan]);
        $model->jenis_pengguna_e_kemudahan = $ref['desc'];
        
        $ref = RefKategoriHakmilik::findOne(['id' => $model->kategory_hakmilik_e_kemudahan]);
        $model->kategory_hakmilik_e_kemudahan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PublicUserEKemudahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PublicUserEKemudahan();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->setPassword($model->new_password);
            $model->generateAuthKey();
            
            $model->category_access = PublicUser::ACCESS_KEMUDAHAN;
            
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
     * Updates an existing PublicUserEKemudahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            if($model->new_password != ''){
                $model->setPassword($model->new_password);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PublicUserEKemudahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PublicUserEKemudahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PublicUserEKemudahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PublicUserEKemudahan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
}
