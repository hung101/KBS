<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPerubatan;
use app\models\AtletPerubatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

// contant values
use app\models\general\GeneralVariable;

// table reference
use app\models\RefKumpulanDarah;
use app\models\RefPenyakit;
use app\models\RefProgramSemasaSukanAtlet;

/**
 * AtletPerubatanController implements the CRUD actions for AtletPerubatan model.
 */
class AtletPerubatanController extends Controller
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
     * Lists all AtletPerubatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AtletPerubatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all AtletPendidikan models.
     * @return mixed
     */
    public function actionTab()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        /*$searchModel = new AtletPerubatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        
        $model = new AtletPerubatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single AtletPerubatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
                
        // get atlet dropdown value's descriptions
        $ref = RefKumpulanDarah::findOne(['id' => $model->kumpulan_darah]);
        $model->kumpulan_darah = $ref['desc'];
        
        $ref = RefPenyakit::findOne(['id' => $model->penyakit_semula_jadi]);
        $model->penyakit_semula_jadi = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPerubatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPerubatan();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $atlet_id = $session['atlet_id'];
            $model->atlet_id = $atlet_id;
        }
        
        $readonly = true;

        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ){
            $readonly = false;
        } else {
            $ref = RefKumpulanDarah::findOne(['id' => $model->kumpulan_darah]);
            $model->kumpulan_darah = $ref['desc'];

            $ref = RefPenyakit::findOne(['id' => $model->penyakit_semula_jadi]);
            $model->penyakit_semula_jadi = $ref['desc'];
        }

        $session->close();
                
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->perubatan_id]);
            return self::actionView($model->perubatan_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => $readonly,
            ]);
        }
    }

    /**
     * Updates an existing AtletPerubatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        //$model = $this->findModel($id);
        
        $session = new Session;
        $session->open();

        $atlet_id = null;
        if(isset($session['atlet_id'])){
            $atlet_id = $session['atlet_id'];
        }
        
        
        $model = AtletPerubatan::find()
                ->where(['atlet_id' => $atlet_id])
                ->one();
        
        
        
        
        
        if ($model !== null) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //return $this->redirect(['view', 'id' => $model->perubatan_id]);
                return self::actionView($model->perubatan_id);
            } else {
                $readonly = true;
                
                if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
                    (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ){
                    $readonly = false;
                } else {
                    $ref = RefKumpulanDarah::findOne(['id' => $model->kumpulan_darah]);
                    $model->kumpulan_darah = $ref['desc'];

                    $ref = RefPenyakit::findOne(['id' => $model->penyakit_semula_jadi]);
                    $model->penyakit_semula_jadi = $ref['desc'];
                }
                
                $renderContent = $this->renderAjax('update', [
                    'model' => $model,
                    'readonly' => $readonly,
                ]);
            }
        } else {
            $renderContent = self::actionCreate();
        }
        
        $session->close();
        
        if(Yii::$app->request->get('typeJson') != NULL && Yii::$app->request->post() == NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->perubatan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }*/
        
    }

    /**
     * Deletes an existing AtletPerubatan model.
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
     * Finds the AtletPerubatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPerubatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPerubatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
