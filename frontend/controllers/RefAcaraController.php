<?php

namespace frontend\controllers;

use Yii;
use app\models\RefAcara;
use frontend\models\RefAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

use yii\helpers\Json;

use app\models\RefSukan;

/**
 * RefAcaraController implements the CRUD actions for RefAcara model.
 */
class RefAcaraController extends Controller
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
     * Lists all RefAcara models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefAcaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefAcara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->ref_sukan_id]);
        $model->ref_sukan_id = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new RefAcara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefAcara();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefAcara model.
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
     * Deletes an existing RefAcara model.
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
     * Finds the RefAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefAcara::findOne($id)) !== null) {
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
    public function actionSubacaras()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getAcarasBySukan($cat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        } else {
			$out = self::getAcarasBySukan(null);
			echo Json::encode(['output'=>$out, 'selected'=>'']);
			return;
		}
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Acaras by Sukan
     * @param integer $id
     * @return Array Bandars
     */
    public static function getAcarasBySukan($sukan_id) {
		if($sukan_id != null){
			$data = RefAcara::find()->where(['ref_sukan_id'=>$sukan_id])->select(['id','desc AS name','discipline'])->asArray()->all();
		} else {
			$data = RefAcara::find()->select(['id','desc AS name','discipline'])->asArray()->all();
		}
        
        for($i=0; $i < count($data); $i++){
            if(isset($data[$i]['discipline']) && $data[$i]['discipline'] != ""){
                $data[$i]['name'] = $data[$i]['discipline'] . ' - ' . $data[$i]['name'];
            }
        }
        
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
}
