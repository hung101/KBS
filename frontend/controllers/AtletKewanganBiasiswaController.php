<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanEBiasiswa;
use frontend\models\PermohonanEBiasiswaSearch;
use app\models\PermohonanBiasiswa;
use frontend\models\PermohonanBiasiswaSearch;
use app\models\Atlet;
use app\models\AtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

/**
 * AtletKewanganBiasiswaController implements the CRUD actions for AtletPerubatanDonator model.
 */
class AtletKewanganBiasiswaController extends Controller
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

        if(isset($session['atlet_id'])){
            if (($model = Atlet::findOne($session['atlet_id'])) !== null) {
                $queryPar['PermohonanEBiasiswaSearch']['no_ic'] = $model->ic_no;
            }
            $queryPar['PermohonanBiasiswaSearch']['atlet'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModelSS = new PermohonanEBiasiswaSearch();
        $dataProviderSS = $searchModelSS->search($queryPar);
        
        $searchModelBI = new PermohonanBiasiswaSearch();
        $dataProviderBI = $searchModelBI->search($queryPar);
        
        $renderContent = $this->renderAjax('index', [
            'searchModelSS' => $searchModelSS,
            'dataProviderSS' => $dataProviderSS,
            'searchModelBI' => $searchModelBI,
            'dataProviderBI' => $dataProviderBI,
        ]);

        if($request->get('typeJson') != NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }
    }
}
