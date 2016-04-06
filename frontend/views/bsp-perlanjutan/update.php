<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_perlanjutan.': ' . ' ' . $model->bsp_perlanjutan_id;
$this->title = GeneralLabel::updateTitle . ' Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelanjutan, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pelanjutan', 'url' => ['view', 'id' => $model->bsp_perlanjutan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPerlanjutanSebab' => $searchModelBspPerlanjutanSebab,
        'dataProviderBspPerlanjutanSebab' => $dataProviderBspPerlanjutanSebab,
        'searchModelBspPerlanjutanDokumen' => $searchModelBspPerlanjutanDokumen,
        'dataProviderBspPerlanjutanDokumen' => $dataProviderBspPerlanjutanDokumen,
        'readonly' => $readonly,
    ]) ?>

</div>
