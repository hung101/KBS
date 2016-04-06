<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPentadbiranPejabat */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bantuan_pentadbiran_pejabat.': ' . ' ' . $model->bantuan_pentadbiran_pejabat_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bantuan_pentadbiran_pejabat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_pentadbiran_pejabat, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_pentadbiran_pejabat, 'url' => ['view', 'id' => $model->bantuan_pentadbiran_pejabat_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-pentadbiran-pejabat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
        'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
        'readonly' => $readonly,
    ]) ?>

</div>
