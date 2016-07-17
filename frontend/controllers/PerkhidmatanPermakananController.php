<?php

namespace frontend\controllers;

use Yii;
use app\models\PerkhidmatanPermakanan;
use frontend\models\PerkhidmatanPermakananSearch;
use app\models\KeputusanAnalisiTubuhBadan;
use frontend\models\KeputusanAnalisiTubuhBadanSearch;
use app\models\PemberianSuplemenMakananJusRundinganPendidikan;
use frontend\models\PemberianSuplemenMakananJusRundinganPendidikanSearch;
use app\models\PemberianJusPemulihan;
use frontend\models\PemberianJusPemulihanSearch;
use app\models\IsnLaporanStatistikMakananTambahan;
use app\models\IsnLaporanStatistikAnalisiTubuhBadan;
use app\models\IsnLaporanStatistikJus;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * PerkhidmatanPermakananController implements the CRUD actions for PerkhidmatanPermakanan model.
 */
class PerkhidmatanPermakananController extends Controller
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
     * Lists all PerkhidmatanPermakanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PerkhidmatanPermakananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerkhidmatanPermakanan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['KeputusanAnalisiTubuhBadanSearch']['perkhidmatan_permakanan_id'] = $id;
        $queryPar['PemberianSuplemenMakananJusRundinganPendidikanSearch']['perkhidmatan_permakanan_id'] = $id;
        $queryPar['PemberianJusPemulihanSearch']['perkhidmatan_permakanan_id'] = $id;
        
        $searchModelKeputusanAnalisiTubuhBadan  = new KeputusanAnalisiTubuhBadanSearch();
        $dataProviderKeputusanAnalisiTubuhBadan = $searchModelKeputusanAnalisiTubuhBadan->search($queryPar);
        
        $searchModelPemberianSuplemenMakananJusRundinganPendidikan  = new PemberianSuplemenMakananJusRundinganPendidikanSearch();
        $dataProviderPemberianSuplemenMakananJusRundinganPendidikan = $searchModelPemberianSuplemenMakananJusRundinganPendidikan->search($queryPar);
        
        $searchModelPemberianJusPemulihan  = new PemberianJusPemulihanSearch();
        $dataProviderPemberianJusPemulihan = $searchModelPemberianJusPemulihan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelKeputusanAnalisiTubuhBadan' => $searchModelKeputusanAnalisiTubuhBadan,
            'dataProviderKeputusanAnalisiTubuhBadan' => $dataProviderKeputusanAnalisiTubuhBadan,
            'searchModelPemberianSuplemenMakananJusRundinganPendidikan' => $searchModelPemberianSuplemenMakananJusRundinganPendidikan,
            'dataProviderPemberianSuplemenMakananJusRundinganPendidikan' => $dataProviderPemberianSuplemenMakananJusRundinganPendidikan,
            'searchModelPemberianJusPemulihan' => $searchModelPemberianJusPemulihan,
            'dataProviderPemberianJusPemulihan' => $dataProviderPemberianJusPemulihan,
            'readonly' => true,
        ]);
    }
    
    /**
     * Creates a new PerkhidmatanPermakanan model.
     * If id is exist or not, the browser will be redirected to the 'create/update' page.
     * @return mixed
     */
    public function actionLoad($permohonan_perkhidmatan_permakanan_id)
    {
        if (($model = PerkhidmatanPermakanan::findOne(['permohonan_perkhidmatan_permakanan_id' => $permohonan_perkhidmatan_permakanan_id])) !== null) {
            return self::actionUpdate($model->perkhidmatan_permakanan_id);
        } else {
            return self::actionCreate($permohonan_perkhidmatan_permakanan_id);
        }
    }

    /**
     * Creates a new PerkhidmatanPermakanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_perkhidmatan_permakanan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PerkhidmatanPermakanan();
        
        $model->permohonan_perkhidmatan_permakanan_id = $permohonan_perkhidmatan_permakanan_id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['KeputusanAnalisiTubuhBadanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PemberianSuplemenMakananJusRundinganPendidikanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PemberianJusPemulihanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelKeputusanAnalisiTubuhBadan  = new KeputusanAnalisiTubuhBadanSearch();
        $dataProviderKeputusanAnalisiTubuhBadan = $searchModelKeputusanAnalisiTubuhBadan->search($queryPar);
        
        $searchModelPemberianSuplemenMakananJusRundinganPendidikan  = new PemberianSuplemenMakananJusRundinganPendidikanSearch();
        $dataProviderPemberianSuplemenMakananJusRundinganPendidikan = $searchModelPemberianSuplemenMakananJusRundinganPendidikan->search($queryPar);
        
        $searchModelPemberianJusPemulihan  = new PemberianJusPemulihanSearch();
        $dataProviderPemberianJusPemulihan = $searchModelPemberianJusPemulihan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                KeputusanAnalisiTubuhBadan::updateAll(['perkhidmatan_permakanan_id' => $model->perkhidmatan_permakanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                KeputusanAnalisiTubuhBadan::updateAll(['session_id' => ''], 'perkhidmatan_permakanan_id = "'.$model->perkhidmatan_permakanan_id.'"');
                
                PemberianSuplemenMakananJusRundinganPendidikan::updateAll(['perkhidmatan_permakanan_id' => $model->perkhidmatan_permakanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PemberianSuplemenMakananJusRundinganPendidikan::updateAll(['session_id' => ''], 'perkhidmatan_permakanan_id = "'.$model->perkhidmatan_permakanan_id.'"');
                
                PemberianJusPemulihan::updateAll(['perkhidmatan_permakanan_id' => $model->perkhidmatan_permakanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PemberianJusPemulihan::updateAll(['session_id' => ''], 'perkhidmatan_permakanan_id = "'.$model->perkhidmatan_permakanan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->perkhidmatan_permakanan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelKeputusanAnalisiTubuhBadan' => $searchModelKeputusanAnalisiTubuhBadan,
                'dataProviderKeputusanAnalisiTubuhBadan' => $dataProviderKeputusanAnalisiTubuhBadan,
                'searchModelPemberianSuplemenMakananJusRundinganPendidikan' => $searchModelPemberianSuplemenMakananJusRundinganPendidikan,
                'dataProviderPemberianSuplemenMakananJusRundinganPendidikan' => $dataProviderPemberianSuplemenMakananJusRundinganPendidikan,
                'searchModelPemberianJusPemulihan' => $searchModelPemberianJusPemulihan,
                'dataProviderPemberianJusPemulihan' => $dataProviderPemberianJusPemulihan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PerkhidmatanPermakanan model.
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
        
        $queryPar = null;
        
        $queryPar['KeputusanAnalisiTubuhBadanSearch']['perkhidmatan_permakanan_id'] = $id;
        $queryPar['PemberianSuplemenMakananJusRundinganPendidikanSearch']['perkhidmatan_permakanan_id'] = $id;
        $queryPar['PemberianJusPemulihanSearch']['perkhidmatan_permakanan_id'] = $id;
        
        $searchModelKeputusanAnalisiTubuhBadan  = new KeputusanAnalisiTubuhBadanSearch();
        $dataProviderKeputusanAnalisiTubuhBadan = $searchModelKeputusanAnalisiTubuhBadan->search($queryPar);
        
        $searchModelPemberianSuplemenMakananJusRundinganPendidikan  = new PemberianSuplemenMakananJusRundinganPendidikanSearch();
        $dataProviderPemberianSuplemenMakananJusRundinganPendidikan = $searchModelPemberianSuplemenMakananJusRundinganPendidikan->search($queryPar);
        
        $searchModelPemberianJusPemulihan  = new PemberianJusPemulihanSearch();
        $dataProviderPemberianJusPemulihan = $searchModelPemberianJusPemulihan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->perkhidmatan_permakanan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelKeputusanAnalisiTubuhBadan' => $searchModelKeputusanAnalisiTubuhBadan,
                'dataProviderKeputusanAnalisiTubuhBadan' => $dataProviderKeputusanAnalisiTubuhBadan,
                'searchModelPemberianSuplemenMakananJusRundinganPendidikan' => $searchModelPemberianSuplemenMakananJusRundinganPendidikan,
                'dataProviderPemberianSuplemenMakananJusRundinganPendidikan' => $dataProviderPemberianSuplemenMakananJusRundinganPendidikan,
                'searchModelPemberianJusPemulihan' => $searchModelPemberianJusPemulihan,
                'dataProviderPemberianJusPemulihan' => $dataProviderPemberianJusPemulihan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PerkhidmatanPermakanan model.
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
     * Finds the PerkhidmatanPermakanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerkhidmatanPermakanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerkhidmatanPermakanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanStatistikMakananTambahan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanStatistikMakananTambahan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-makanan-tambahan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'kategori_makanan_tambahan' => $model->kategori_makanan_tambahan
                    , 'sukan' => $model->sukan
                    , 'atlet' => $model->atlet
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-makanan-tambahan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kategori_makanan_tambahan' => $model->kategori_makanan_tambahan
                    , 'sukan' => $model->sukan
                    , 'atlet' => $model->atlet
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_makanan_tambahan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikMakananTambahan($tarikh_dari, $tarikh_hingga, $kategori_makanan_tambahan, $sukan, $atlet, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($kategori_makanan_tambahan == "") $kategori_makanan_tambahan = array();
        else $kategori_makanan_tambahan = array($kategori_makanan_tambahan);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'KATEGORI_MAKANAN_TAMBAHAN' => $kategori_makanan_tambahan,
            'SUKAN' => $sukan,
            'ATLET' => $atlet,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanStatistikMakananTambahan', $format, $controls, 'laporan_statistik_makanan_tambahan');
    }
    
    public function actionLaporanStatistikAnalisiTubuhBadan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanStatistikAnalisiTubuhBadan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-analisi-tubuh-badan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-analisi-tubuh-badan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_analisi_tubuh_badan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAnalisiTubuhBadan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanStatistikAnalisiTubuhBadan', $format, $controls, 'laporan_statistik_analisi_tubuh_badan');
    }
    
    public function actionLaporanStatistikJus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanStatistikJus();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'jenis_jus' => $model->jenis_jus
                    , 'nama_jus' => $model->nama_jus
                    , 'sukan' => $model->sukan
                    , 'atlet' => $model->atlet
                    , 'kategori_atlet' => $model->kategori_atlet
                    , 'jantina' => $model->jantina
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jus'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'jenis_jus' => $model->jenis_jus
                    , 'nama_jus' => $model->nama_jus
                    , 'sukan' => $model->sukan
                    , 'atlet' => $model->atlet
                    , 'kategori_atlet' => $model->kategori_atlet
                    , 'jantina' => $model->jantina
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJus($tarikh_dari, $tarikh_hingga, $jenis_jus, $nama_jus, $sukan, $atlet, $kategori_atlet, $jantina, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($jenis_jus == "") $jenis_jus = array();
        else $jenis_jus = array($jenis_jus);
        
        if($nama_jus == "") $nama_jus = array();
        else $nama_jus = array($nama_jus);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($kategori_atlet == "") $kategori_atlet = array();
        else $kategori_atlet = array($kategori_atlet);
        
        if($jantina == "") $jantina = array();
        else $jantina = array($jantina);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'JENIS_JUS' => $jenis_jus,
            'NAMA_JUS' => $nama_jus,
            'SUKAN' => $sukan,
            'ATLET' => $atlet,
            'KATEGORI_ATLET' => $kategori_atlet,
            'JANTINA' => $jantina,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanStatistikJus', $format, $controls, 'laporan_statistik_jus');
    }
}
