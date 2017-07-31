<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPencapaian;
use frontend\models\AtletPencapaianSearch;
use app\models\AtletPencapaianRekods;
use frontend\models\AtletPencapaianRekodsSearch;
use app\models\PenilaianPestasi;
use app\models\PenilaianPestasiSearch;
use app\models\PenilaianPrestasiAtletSasaran;
use frontend\models\PenilaianPrestasiAtletSasaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefJenisRekod;
use app\models\RefKeputusan;

/**
 * AtletPencapaianController implements the CRUD actions for AtletPencapaian model.
 */
class AtletPencapaianController extends Controller
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
//delete()
    /**
     * Lists all AtletPencapaian models.
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
            $queryPar['AtletPencapaianSearch']['atlet_id'] = $session['atlet_id'];
            $queryPar['PenilaianPestasiSearch']['atlet'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletPencapaianSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelPP = new PenilaianPestasiSearch();
        $dataProviderPP = $searchModelPP->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPP' => $searchModelPP,
            'dataProviderPP' => $dataProviderPP,
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
        
        $searchModel = new AtletPencapaianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
        /*$searchModel = new AtletPencapaianRekodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $model = new AtletPencapaian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }*/
    }

    /**
     * Displays a single AtletPencapaian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['AtletPencapaianRekodsSearch']['pencapaian_id'] = $id;
        
        $searchModelRekods = new AtletPencapaianRekodsSearch();
        $dataProviderRekods = $searchModelRekods->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefPeringkatKejohananTemasya::findOne(['id' => $model->peringkat_kejohanan]);
        $model->peringkat_kejohanan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = RefJenisRekod::findOne(['id' => $model->jenis_rekod]);
        $model->jenis_rekod = $ref['desc'];
        
        $ref = RefKeputusan::findOne(['id' => $model->pencapaian]);
        $model->pencapaian = $ref['desc'];
        
        if($model->tarikh_mula_kejohanan != "") {$model->tarikh_mula_kejohanan = GeneralFunction::convert($model->tarikh_mula_kejohanan, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat_kejohanan != "") {$model->tarikh_tamat_kejohanan = GeneralFunction::convert($model->tarikh_tamat_kejohanan, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'searchModelRekods' => $searchModelRekods,
            'dataProviderRekods' => $dataProviderRekods,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPencapaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPencapaian();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $model->atlet_id = $session['atlet_id'];
        }
        
        $session->close();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AtletPencapaianRekodsSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelRekods  = new AtletPencapaianRekodsSearch();
        $dataProviderRekods = $searchModelRekods->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AtletPencapaianRekods::updateAll(['pencapaian_id' => $model->pencapaian_id], 'session_id = "'.Yii::$app->session->id.'"');
                AtletPencapaianRekods::updateAll(['session_id' => ''], 'pencapaian_id = "'.$model->pencapaian_id.'"');
            }
            
            //return $this->redirect(['view', 'id' => $model->pencapaian_id]);
            return self::actionView($model->pencapaian_id);
        }
        
        return $this->renderAjax('create', [
            'model' => $model,
            'searchModelRekods' => $searchModelRekods,
            'dataProviderRekods' => $dataProviderRekods,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing AtletPencapaian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['AtletPencapaianRekodsSearch']['pencapaian_id'] = $id;
        
        $searchModelRekods = new AtletPencapaianRekodsSearch();
        $dataProviderRekods = $searchModelRekods->search($queryPar);
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (($modelPenilaianPrestasiAtletSasaran = PenilaianPrestasiAtletSasaran::findOne($model->penilaian_prestasi_atlet_sasaran_id)) !== null) {
                $modelPenilaianPrestasiAtletSasaran->keputusan = $model->pencapaian;
                $modelPenilaianPrestasiAtletSasaran->save();
            } 
            
            //return $this->redirect(['view', 'id' => $model->pencapaian_id]);
            return self::actionView($model->pencapaian_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'searchModelRekods' => $searchModelRekods,
                'dataProviderRekods' => $dataProviderRekods,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletPencapaian model.
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
     * Finds the AtletPencapaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPencapaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPencapaian::findOne($id)) !== null) {
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
    public function actionSubKejohananTemasya()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getChild($cat_id); 
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
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getChild($atlet_id) {
        $data = AtletPencapaian::find()->where('nama_kejohanan_temasya <> ""')->andWhere(['atlet_id'=>$atlet_id])->select(['pencapaian_id AS id','nama_kejohanan_temasya AS name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['atlet-pencapaian_sukan_id'] = $sukan_id;
        
        $session->close();
    }
}
