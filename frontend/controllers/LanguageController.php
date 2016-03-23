<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;

/**
 * LanguageController implements the CRUD actions for AtletSukan model.
 */
class LanguageController extends Controller
{

    /**
     * Switch Language.
     * @param string $language
     * @return mixed
     */
    public function actionChange($language)
    {
        $session = Yii::$app->getSession();

        $current_language = $session->set('language', $language);

        //return Yii::$app->request->referrer;
        $this->redirect(Yii::$app->request->referrer);
    }

}
