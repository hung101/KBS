<?php

namespace frontend\controllers;

use Yii;
use app\models\LaporanPemantauanJurulatihKategori;
use frontend\models\LaporanPemantauanJurulatihKategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriLaporanPenilaianJurulatih;
use app\models\RefSubKategoriLaporanPenilaianJurulatih;

/**
 * LaporanPemantauanJurulatihKategoriController implements the CRUD actions for LaporanPemantauanJurulatihKategori model.
 */
class LaporanPemantauanJurulatihKategoriController extends Controller
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
     * Lists all LaporanPemantauanJurulatihKategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LaporanPemantauanJurulatihKategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LaporanPemantauanJurulatihKategori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriLaporanPenilaianJurulatih::findOne(['id' => $model->penilaian_kategori]);
        $model->penilaian_kategori = $ref['desc'];
        
        $ref = RefSubKategoriLaporanPenilaianJurulatih::findOne(['id' => $model->penilaian_sub_kategori]);
        $model->penilaian_sub_kategori = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LaporanPemantauanJurulatihKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($laporan_pemantauan_jurulatih_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LaporanPemantauanJurulatihKategori();
        
        Yii::$app->session->open();
        
        if($laporan_pemantauan_jurulatih_id != ''){
            $model->laporan_pemantauan_jurulatih_id = $laporan_pemantauan_jurulatih_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }
        
        // if(Yii::$app->request->post())
        // {
            // $file = UploadedFile::getInstance($model, 'muat_naik');
            // if(isset($file) && $file != null){                
                // $filename = $model->laporan_pemantauan_jurulatih_kategori_id . "-muat_naik";
                // $model->muat_naik = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            // }
            // die;
        // }    
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if(isset($file) && $file != null){                
                $filename = $model->laporan_pemantauan_jurulatih_kategori_id . "-muat_naik";
                $model->muat_naik = Upload::uploadFile($file, Upload::laporanPemantauanJurulatihKategoriFolder, $filename);
                $model->save();
            }
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LaporanPemantauanJurulatihKategori model.
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
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if(isset($file) && $file != null){
                $filename = $model->laporan_pemantauan_jurulatih_kategori_id . "-muat_naik";
                $model->muat_naik = Upload::uploadFile($file, Upload::laporanPemantauanJurulatihKategoriFolder, $filename);
                $model->save();
            }
            
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LaporanPemantauanJurulatihKategori model.
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
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $img = $this->findModel($id)->$field;
        
        if($img){
/*                 if (!unlink($img)) {
				return false;
			} */
			@unlink($img);
        }

        $img = $this->findModel($id);
        $img->$field = NULL;
        $img->update();

        return '1';
    }

    /**
     * Finds the LaporanPemantauanJurulatihKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LaporanPemantauanJurulatihKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaporanPemantauanJurulatihKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
