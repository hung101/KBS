<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasa */

$this->title = 'Maklumat Mesyuarat Agung Tahunan';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Mesyuarat Agung Tahunan', 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-create">

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
