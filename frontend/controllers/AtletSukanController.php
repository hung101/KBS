<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletSukan;
use app\models\AtletSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefCawangan;
use app\models\RefNegeri;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefStatusSukanAtlet;
use app\models\RefSource;
use app\models\ProfilPusatLatihan;

/**
 * AtletSukanController implements the CRUD actions for AtletSukan model.
 */
class AtletSukanController extends Controller
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
     * Lists all AtletSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $request = Yii::$app->request;
        
        $queryPar = Yii::$app->request->queryParams;
        
        // Filter by atlet id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $queryPar['AtletSukanSearch']['atlet_id'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletSukanSearch();
        $dataProvider = $searchModel->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        if($request->get('typeJson') != NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }
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
        
        /*$searchModel = new AtletSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        
        $model = new AtletSukan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single AtletSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih_id]);
        $model->jurulatih_id = $ref['nameAndIC'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program_semasa]);
        $model->program_semasa = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri_diwakili]);
        $model->negeri_diwakili = $ref['desc'];
        
        $ref = RefStatusSukanAtlet::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefSource::findOne(['id' => $model->source]);
        $model->source = $ref['desc'];
        
        $ref = ProfilPusatLatihan::findOne(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id]);
        $model->profil_pusat_latihan_id = $ref['nama_pusat_latihan'];
        
        if($model->tarikh_mula_menyertai_program_msn != "") {$model->tarikh_mula_menyertai_program_msn = GeneralFunction::convert($model->tarikh_mula_menyertai_program_msn, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat_menyertai_program_msn != "") {$model->tarikh_tamat_menyertai_program_msn = GeneralFunction::convert($model->tarikh_tamat_menyertai_program_msn, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_kelulusan != "") {$model->tarikh_kelulusan = GeneralFunction::convert($model->tarikh_kelulusan, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletSukan();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $model->atlet_id = $session['atlet_id'];
        }
        
        $session->close();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->sukan_id]);
            return self::actionView($model->sukan_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AtletSukan model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->sukan_id]);
            return self::actionView($model->sukan_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletSukan model.
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

        //return $this->redirect(['index']);
        return self::actionIndex();
    }

    /**
     * Finds the AtletSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id
     * @return mixed
     */
    public function actionAtletsBySukan()
    {
        $out = [];
        /*if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = self::getAtletsBySukan($id); 
            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                
                $param1 = null;
                
                if (isset($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value list atlet selected
                }
            
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['name']];
                    
                }
                
                if ($param1 != "") {
                    //$selected = '[1,2]';
                }
                    
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }*/
        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getAtletsBySukan($cat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Atlets by Sukan
     * @param integer $id
     * @return Array Atlets
     */
    public static function getAtletsBySukan($sukan_id) {
        $data = AtletSukan::find()->joinWith(['refAtlet'])->andWhere('`tbl_atlet`.`atlet_id` IS NOT NULL')->select(['DISTINCT(`tbl_atlet`.`atlet_id`) AS id','tbl_atlet.name_penuh AS name']);
        
        if($sukan_id!="" && isset($sukan_id)){
            $data = $data->andWhere(['nama_sukan'=>$sukan_id]);
        }
                    
        $data = $data->createCommand()->queryAll();
        
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
}
