<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasa */

//$this->title = 'Update Ltbs Minit Mesyuarat Jawatankuasa: ' . ' ' . $model->mesyuarat_id;
$this->title = 'Maklumat Mesyuarat Agung Tahunan';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Mesyuarat Agung Tahunan', 'url' => Url::to(['index', 'profil_badan_sukan_id' => $model->profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->mesyuarat_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelDMN' => $searchModelDMN,
        'dataProviderDMN' => $dataProviderDMN,
        'searchModelSNH' => $searchModelSNH,
        'dataProviderSNH' => $dataProviderSNH,
        'searchModelNMA' => $searchModelNMA,
        'dataProviderNMA' => $dataProviderNMA,
        'searchModelSNKMA' => $searchModelSNKMA,
        'dataProviderSNKMA' => $dataProviderSNKMA,
    ]) ?>

</div>
