<?php

namespace frontend\controllers;

use Yii;
use app\models\MaklumatAkademik;
use frontend\models\MaklumatAkademikSearch;
use app\models\MaklumatAkademikJadual;
use frontend\models\MaklumatAkademikJadualSearch;
use app\models\MaklumatAkademikSubjek;
use frontend\models\MaklumatAkademikSubjekSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Atlet;
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;

/**
 * MaklumatAkademikController implements the CRUD actions for MaklumatAkademik model.
 */
class MaklumatAkademikController extends Controller
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
     * Lists all MaklumatAkademik models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaklumatAkademikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaklumatAkademik model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
		
		$queryPar = null;
        
        $queryPar['MaklumatAkademikJadualSearch']['maklumat_akademik_id'] = $id;
		$queryPar['MaklumatAkademikSubjekSearch']['maklumat_akademik_id'] = $id;
		
		$searchModelMaklumatAkademikJadual  = new MaklumatAkademikJadualSearch();
        $dataProviderMaklumatAkademikJadual = $searchModelMaklumatAkademikJadual->search($queryPar);
		
		$searchModelMaklumatAkademikSubjek  = new MaklumatAkademikSubjekSearch();
        $dataProviderMaklumatAkademikSubjek = $searchModelMaklumatAkademikSubjek->search($queryPar);
		
		$ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIc'];
		
		$ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
		
        return $this->render('view', [
            'model' => $model,
			'searchModelMaklumatAkademikJadual' => $searchModelMaklumatAkademikJadual,
			'dataProviderMaklumatAkademikJadual' => $dataProviderMaklumatAkademikJadual,
			'searchModelMaklumatAkademikSubjek' => $searchModelMaklumatAkademikSubjek,
			'dataProviderMaklumatAkademikSubjek' => $dataProviderMaklumatAkademikSubjek,
			'readonly' => true,
        ]);
    }

    /**
     * Creates a new MaklumatAkademik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MaklumatAkademik();
		
		$queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['MaklumatAkademikJadualSearch']['session_id'] = Yii::$app->session->id;
			$queryPar['MaklumatAkademikSubjekSearch']['session_id'] = Yii::$app->session->id;
        }
		
		$searchModelMaklumatAkademikJadual  = new MaklumatAkademikJadualSearch();
        $dataProviderMaklumatAkademikJadual = $searchModelMaklumatAkademikJadual->search($queryPar);
        
        $searchModelMaklumatAkademikSubjek  = new MaklumatAkademikSubjekSearch();
        $dataProviderMaklumatAkademikSubjek = $searchModelMaklumatAkademikSubjek->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if(isset(Yii::$app->session->id)){
                MaklumatAkademikJadual::updateAll(['maklumat_akademik_id' => $model->maklumat_akademik_id], 'session_id = "'.Yii::$app->session->id.'"');
                MaklumatAkademikJadual::updateAll(['session_id' => ''], 'maklumat_akademik_id = "'.$model->maklumat_akademik_id.'"');
				
				MaklumatAkademikSubjek::updateAll(['maklumat_akademik_id' => $model->maklumat_akademik_id], 'session_id = "'.Yii::$app->session->id.'"');
                MaklumatAkademikSubjek::updateAll(['session_id' => ''], 'maklumat_akademik_id = "'.$model->maklumat_akademik_id.'"');
			}
			
            return $this->redirect(['view', 'id' => $model->maklumat_akademik_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'searchModelMaklumatAkademikJadual' => $searchModelMaklumatAkademikJadual,
				'dataProviderMaklumatAkademikJadual' => $dataProviderMaklumatAkademikJadual,
				'searchModelMaklumatAkademikSubjek' => $searchModelMaklumatAkademikSubjek,
				'dataProviderMaklumatAkademikSubjek' => $dataProviderMaklumatAkademikSubjek,
				'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing MaklumatAkademik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$queryPar = null;
        
        $queryPar['MaklumatAkademikJadualSearch']['maklumat_akademik_id'] = $id;
		$queryPar['MaklumatAkademikSubjekSearch']['maklumat_akademik_id'] = $id;
		
		$searchModelMaklumatAkademikJadual  = new MaklumatAkademikJadualSearch();
        $dataProviderMaklumatAkademikJadual = $searchModelMaklumatAkademikJadual->search($queryPar);
		
		$searchModelMaklumatAkademikSubjek  = new MaklumatAkademikSubjekSearch();
        $dataProviderMaklumatAkademikSubjek = $searchModelMaklumatAkademikSubjek->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->maklumat_akademik_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'searchModelMaklumatAkademikJadual' => $searchModelMaklumatAkademikJadual,
				'dataProviderMaklumatAkademikJadual' => $dataProviderMaklumatAkademikJadual,
				'searchModelMaklumatAkademikSubjek' => $searchModelMaklumatAkademikSubjek,
				'dataProviderMaklumatAkademikSubjek' => $dataProviderMaklumatAkademikSubjek,
				'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing MaklumatAkademik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionPrint($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$MaklumatAkademikJadual = MaklumatAkademikJadual::find()->where(['maklumat_akademik_id' => $model->maklumat_akademik_id])->orderBy('hari')->all();
		$MaklumatAkademikSubjek = MaklumatAkademikSubjek::find()->where(['maklumat_akademik_id' => $model->maklumat_akademik_id])->orderBy('subjek')->all();
		
		$ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIc'];
		
		$ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
		
		$pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang Maklumat Akademik';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
			 'MaklumatAkademikJadual' => $MaklumatAkademikJadual,
			 'MaklumatAkademikSubjek' => $MaklumatAkademikSubjek,
        ]));

        $pdf->Output('Borang_Maklumat_Akademik'.$model->maklumat_akademik_id.'.pdf', 'I'); 	
	}

    /**
     * Finds the MaklumatAkademik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaklumatAkademik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaklumatAkademik::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
