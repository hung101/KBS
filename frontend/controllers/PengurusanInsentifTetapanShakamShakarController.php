<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanInsentifTetapanShakamShakar;
use frontend\models\PengurusanInsentifTetapanShakamShakarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Session;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisInsentif;
use app\models\RefPingatInsentif;
use app\models\RefInsentifKejohanan;
use app\models\RefInsentifPeringkat;
use app\models\RefInsentifKelas;

/**
 * PengurusanInsentifTetapanShakamShakarController implements the CRUD actions for PengurusanInsentifTetapanShakamShakar model.
 */
class PengurusanInsentifTetapanShakamShakarController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all PengurusanInsentifTetapanShakamShakar models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanInsentifTetapanShakamShakarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanInsentifTetapanShakamShakar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisInsentif::findOne(['id' => $model->jenis_insentif]);
        $model->jenis_insentif = $ref['desc'];
        
        $ref = RefPingatInsentif::findOne(['id' => $model->pingat]);
        $model->pingat = $ref['desc'];
        
        $ref = RefInsentifKejohanan::findOne(['id' => $model->kejohanan]);
        $model->kejohanan = $ref['desc'];
        
        $ref = RefInsentifPeringkat::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefInsentifKelas::findOne(['id' => $model->kelas]);
        $model->kelas = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanInsentifTetapanShakamShakar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_insentif_tetapan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanInsentifTetapanShakamShakar();
        
        Yii::$app->session->open();
        
        if($pengurusan_insentif_tetapan_id != ''){
            $model->pengurusan_insentif_tetapan_id = $pengurusan_insentif_tetapan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanInsentifTetapanShakamShakar model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanInsentifTetapanShakamShakar model.
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
    }

    /**
     * Finds the PengurusanInsentifTetapanShakamShakar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanInsentifTetapanShakamShakar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanInsentifTetapanShakamShakar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Get Acaras base on Sukan id
     * @param integer $id
     * @return mixed
     */
    public function actionSubkumpulans()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            if ($ids != null) {
                $cat_id = empty($ids[0]) ? null : $ids[0];
                $subcat_id = empty($ids[1]) ? null : $ids[1];
                $subsubcat_id = empty($ids[1]) ? null : $ids[2];
                $out = self::getChilds($cat_id, $subcat_id, $subsubcat_id); 
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
     * get list of Acaras by Sukan
     * @param integer $id
     * @return Array Bandars
     */
    public static function getChilds($jenis_insentif_id, $pingat_id, $rekod_baharu) {
        $data = PengurusanInsentifTetapanShakamShakar::find()->where(['jenis_insentif'=>$jenis_insentif_id, 'pingat'=>$pingat_id, 'rekod_baharu'=>$rekod_baharu])->select(['pengurusan_insentif_tetapan_shakam_shakar_id AS id','kumpulan_temasya_kejohanan AS name'])->asArray()->all();
        
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionGetJumlah($jenis_insentif, $kejohanan, $pingat, $peringkat, $kelas){
        //$model = PengurusanInsentifTetapanShakamShakar::findOne($id);
        if($kelas != ''){
            $model = PengurusanInsentifTetapanShakamShakar::find()->joinWith(['refPengurusanInsentifTetapan'])->where(['jenis_insentif'=>$jenis_insentif, 'kejohanan'=>$kejohanan, 'pingat'=>$pingat, 'peringkat'=>$peringkat, 'kelas'=>$kelas])->asArray()->one();
        } else {
            $model = PengurusanInsentifTetapanShakamShakar::find()->joinWith(['refPengurusanInsentifTetapan'])->where(['jenis_insentif'=>$jenis_insentif, 'kejohanan'=>$kejohanan, 'pingat'=>$pingat, 'peringkat'=>$peringkat])->asArray()->one();
        }
        
        $session = new Session;
        $session->open();

        $session['nilai_SGAR_individu'] = $model['nilai_individu'] * ($model['refPengurusanInsentifTetapan']['sgar'] / 100);
        $session['nilai_SGAR_berpasukan'] = $model['nilai_berpasukan_kurang_5'] * ($model['refPengurusanInsentifTetapan']['sgar'] / 100);
        
        $session->close();
        
        echo Json::encode($model);
    }
}
