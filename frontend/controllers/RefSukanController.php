<?php

namespace frontend\controllers;

use Yii;
use app\models\RefSukan;
use frontend\models\RefSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use yii\helpers\Json;

/**
 * RefSukanController implements the CRUD actions for RefSukan model.
 */
class RefSukanController extends Controller
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
     * Lists all RefSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefSukan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefSukan model.
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
     * Finds the RefSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefSukan::findOne($id)) !== null) {
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
    public function actionSubsukan()
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
    public static function getChild($kategori_id) {
        // Session
        $session = new Session;
        $session->open();
        
        if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
            $data = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->select(['id','desc AS name'])->asArray()->all();
        } else {
            $data = RefSukan::find()->where(['ref_cawangan_id'=>$kategori_id])->andWhere(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->select(['id','desc AS name'])->asArray()->all();
        }
        
        if(!isset($session['atlet_cacat'])){
            $data = RefSukan::find()->where(['ref_cawangan_id'=>$kategori_id])->andWhere(['=', 'aktif', 1])->select(['id','desc AS name'])->asArray()->all();
        }
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
                $data = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->select(['id','desc AS name'])->asArray()->all();
            } else {
                $data = RefSukan::find()->where(['ref_cawangan_id'=>$kategori_id])->andWhere(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->andFilterWhere(['id'=>$arr_sukan_filter])->select(['id','desc AS name'])->asArray()->all();
            }

            if(!isset($session['atlet_cacat'])){
                $data = RefSukan::find()->where(['ref_cawangan_id'=>$kategori_id])->andWhere(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->select(['id','desc AS name'])->asArray()->all();
            }
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        $value = (count($data) == 0) ? ['' => ''] : $data;
        
        
        $session->close();

        return $value;
    }
}
