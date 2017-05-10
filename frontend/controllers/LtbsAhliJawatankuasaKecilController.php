<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsAhliJawatankuasaKecil;
use frontend\models\LtbsAhliJawatankuasaKecilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJawatan;
use app\models\RefJantina;
use app\models\RefBangsa;
use app\models\ProfilBadanSukan;
use app\models\RefStatusLaporanMesyuaratAgung;

/**
 * LtbsAhliJawatankuasaKecilController implements the CRUD actions for LtbsAhliJawatankuasaKecil model.
 */
class LtbsAhliJawatankuasaKecilController extends Controller
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
     * Lists all LtbsAhliJawatankuasaKecil models.
     * @return mixed
     */
    public function actionIndex($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if($profil_badan_sukan_id!=""){
            $queryParams['LtbsAhliJawatankuasaKecilSearch']['profil_badan_sukan_id'] = $profil_badan_sukan_id;
        }
        
        $searchModel = new LtbsAhliJawatankuasaKecilSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Displays a single LtbsAhliJawatankuasaKecil model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // get details
        $model = $this->findModel($id);
        
        // get dropdown value's descriptions
        $ref = RefJawatan::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        $model->tarikh_mula_memegang_jawatan = GeneralFunction::convert($model->tarikh_mula_memegang_jawatan);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Creates a new LtbsAhliJawatankuasaKecil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LtbsAhliJawatankuasaKecil();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
            $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
        } else if($profil_badan_sukan_id!=""){
            $model->profil_badan_sukan_id = $profil_badan_sukan_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ahli_jawatan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'profil_badan_sukan_id' => $profil_badan_sukan_id,
            ]);
        }
    }

    /**
     * Updates an existing LtbsAhliJawatankuasaKecil model.
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
            if(Yii::$app->user->identity->profil_badan_sukan){
                // set status to 'Belum Disahkan' if any changes made for persatuan
                $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->ahli_jawatan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing LtbsAhliJawatankuasaKecil model.
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
     * Finds the LtbsAhliJawatankuasaKecil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsAhliJawatankuasaKecil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsAhliJawatankuasaKecil::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetAhliJawatankuasaKecil($id){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // find Ahli Jawatankuasa Induk
        $model = LtbsAhliJawatankuasaKecil::find()->joinWith('badanSukan')->joinWith('refJawatan')->where(['ahli_jawatan_id' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
    
    /**
     * Get AhliJawatan base on BadanSukan id
     * @param integer $id
     * @return mixed
     */
    public function actionGetAhliJawatankuasaKecilByBadansukan(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getAhliJawatankuasaKecilByBadansukan($cat_id); 
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
     * get list of Ahli Jawatan by Badan Sukan
     * @param integer $id
     * @return Array AhliJawatans
     */
    public static function getAhliJawatankuasaKecilByBadansukan($badan_sukan_id) {
        
        $data = LtbsAhliJawatankuasaKecil::find()->where(['profil_badan_sukan_id'=>$badan_sukan_id])->select(['ahli_jawatan_id AS id','nama_penuh AS name'])->asArray()->all();
        $value = (count($data) == 0) ? ['id' => '', 'name' => ''] : $data;

        return $value;
    }
	
	public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		// get dropdown value's descriptions
        $ref = RefJawatan::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        $model->tarikh_mula_memegang_jawatan = GeneralFunction::convert($model->tarikh_mula_memegang_jawatan);

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Ahli Jawatankuasa Kecil / Biro';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->ahli_jawatan_id.'.pdf', 'I');
    }
}
