<?php

namespace frontend\controllers;

use Yii;
use app\models\SixStep;
use frontend\models\SixStepSearch;
use app\models\SixStepBiomekanik;
use frontend\models\SixStepBiomekanikSearch;
use app\models\SixStepFisiologi;
use frontend\models\SixStepFisiologiSearch;
use app\models\SixStepPsikologi;
use frontend\models\SixStepPsikologiSearch;
use app\models\SixStepSatelit;
use frontend\models\SixStepSatelitSearch;
use app\models\SixStepSuaianFizikal;
use frontend\models\SixStepSuaianFizikalSearch;
use app\models\PlTemujanji;
use frontend\models\PlTemujanjiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

/**
 * AtletPerubatanRekodsController implements the CRUD actions for AtletPerubatanDonator model.
 */
class AtletPerubatanRekodsController extends Controller
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
            $queryPar['SixStepSearch']['atlet'] = $session['atlet_id'];
            $queryPar['SixStepBiomekanikSearch']['atlet'] = $session['atlet_id'];
            $queryPar['SixStepFisiologiSearch']['atlet'] = $session['atlet_id'];
            $queryPar['SixStepPsikologiSearch']['atlet'] = $session['atlet_id'];
            $queryPar['SixStepSatelitSearch']['atlet'] = $session['atlet_id'];
            $queryPar['SixStepSuaianFizikalSearch']['atlet'] = $session['atlet_id'];
            $queryPar['PlTemujanjiSearch']['atlet'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModelSS = new SixStepSearch();
        $dataProviderSS = $searchModelSS->search($queryPar);
        
        $searchModelSSB = new SixStepBiomekanikSearch();
        $dataProviderSSB = $searchModelSSB->search($queryPar);
        
        $searchModelSSF = new SixStepFisiologiSearch();
        $dataProviderSSF = $searchModelSSF->search($queryPar);
        
        $searchModelSSP = new SixStepPsikologiSearch();
        $dataProviderSSP = $searchModelSSP->search($queryPar);
        
        $searchModelSSS = new SixStepSatelitSearch();
        $dataProviderSSS = $searchModelSSS->search($queryPar);
        
        $searchModelSSSF = new SixStepSuaianFizikalSearch();
        $dataProviderSSSF = $searchModelSSSF->search($queryPar);
        
        $searchModelPLT = new PlTemujanjiSearch();
        $dataProviderPLT = $searchModelPLT->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModelSS' => $searchModelSS,
            'dataProviderSS' => $dataProviderSS,
            'searchModelSSB' => $searchModelSSB,
            'dataProviderSSB' => $dataProviderSSB,
            'searchModelSSF' => $searchModelSSF,
            'dataProviderSSF' => $dataProviderSSF,
            'searchModelSSP' => $searchModelSSP,
            'dataProviderSSP' => $dataProviderSSP,
            'searchModelSSS' => $searchModelSSS,
            'dataProviderSSS' => $dataProviderSSS,
            'searchModelSSSF' => $searchModelSSSF,
            'dataProviderSSSF' => $dataProviderSSSF,
            'searchModelPLT' => $searchModelPLT,
            'dataProviderPLT' => $dataProviderPLT,
        ]);

        if($request->get('typeJson') != NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }
    }
}
