<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPemantauanDanPenilaianJurulatih;
use frontend\models\PengurusanPemantauanDanPenilaianJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

/**
 * JurulatihPenilaianController implements the CRUD actions for AtletPerubatanDonator model.
 */
class JurulatihPenilaianController extends Controller
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
     * Lists all AtletPerubatanDonator models.
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

        if(isset($session['jurulatih_id'])){
            $queryPar['PengurusanPemantauanDanPenilaianJurulatihSearch']['jurulatih'] = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $searchModel = new PengurusanPemantauanDanPenilaianJurulatihSearch();
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
}
