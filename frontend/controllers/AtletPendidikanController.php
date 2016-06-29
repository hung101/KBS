<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPendidikan;
use app\models\AtletPendidikanSearch;
use app\models\PertukaranPengajian;
use frontend\models\PertukaranPengajianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\RefJenisPencapaian;

/**
 * AtletPendidikanController implements the CRUD actions for AtletPendidikan model.
 */
class AtletPendidikanController extends Controller
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
     * Lists all AtletPendidikan models.
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
            $queryPar['PertukaranPengajianSearch']['atlet'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletPendidikanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelPP = new PertukaranPengajianSearch();
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
        /*$searchModel = new AtletPendidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        
        $model = new AtletPendidikan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single AtletPendidikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // get atlet details
        $atletPendidikan = $this->findModel($id);
        
        // get atlet dropdown value's descriptions
        $ref = \app\models\RefTahapPendidikan::findOne(['id' => $atletPendidikan->jenis_peringkatan_pendidikan]);
        $atletPendidikan->jenis_peringkatan_pendidikan = $ref['desc'];
        
        $ref = \app\models\RefNegeri::findOne(['id' => $atletPendidikan->alamat_negeri]);
        $atletPendidikan->alamat_negeri = $ref['desc'];
        
        $ref = \app\models\RefBandar::findOne(['id' => $atletPendidikan->alamat_bandar]);
        $atletPendidikan->alamat_bandar = $ref['desc'];
        
        $ref = \app\models\RefJenisBiasiswa::findOne(['id' => $atletPendidikan->jenis_biasiswa]);
        $atletPendidikan->jenis_biasiswa = $ref['desc'];
        
        $ref = \app\models\RefJenisPencapaian::findOne(['id' => $atletPendidikan->jenis_pencapaian]);
        $atletPendidikan->jenis_pencapaian = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $atletPendidikan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AtletPendidikan();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $atlet_id = $session['atlet_id'];
            $model->atlet_id = $atlet_id;
        }
        
        $session->close();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
            return self::actionView($model->pendidikan_atlet_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AtletPendidikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
            //Yii::$app->runAction('view',  ['id' => $model->pendidikan_atlet_id]);
            return self::actionView($model->pendidikan_atlet_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletPendidikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        //return $this->redirect(['index']);
        return self::actionIndex();
    }

    /**
     * Finds the AtletPendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPendidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
