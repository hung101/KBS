<?php

namespace frontend\controllers;

use Yii;
use app\models\RefSoalanPenganjur;
use frontend\models\RefSoalanPenganjurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\Json;

/**
 * RefSoalanPenganjurController implements the CRUD actions for RefSoalanPenganjur model.
 */
class RefSoalanPenganjurController extends Controller
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
     * Lists all RefSoalanPenganjur models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSoalanPenganjurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefSoalanPenganjur model.
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
     * Creates a new RefSoalanPenganjur model.
     * If creation is successful, delete()the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefSoalanPenganjur();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefSoalanPenganjur model.
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
     * Deletes an existing RefSoalanPenganjur model.
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
     * Finds the RefSoalanPenganjur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefSoalanPenganjur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefSoalanPenganjur::findOne($id)) !== null) {
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
    public function actionSubSoalan()
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
        $data = RefSoalanPenganjur::find()->where(['ref_kategori_soalan_penganjur_id'=>$kategori_id])->select(['id','desc AS name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
}
