<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKem */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_perhimpunan_kem.': ' . ' ' . $model->pengurusan_perhimpunan_kem_id;
$this->title = GeneralLabel::updateTitle . ' Bantuan Geran Penganjuran';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_geran_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Bantuan Geran Penganjuran', 'url' => ['view', 'id' => $model->pengurusan_perhimpunan_kem_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhimpunan-kem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPerhimpunanKemKos' => $searchModelPerhimpunanKemKos,
        'dataProviderPerhimpunanKemKos' => $dataProviderPerhimpunanKemKos,
        'searchModelPerhimpunanKemPeserta' => $searchModelPerhimpunanKemPeserta,
        'dataProviderPerhimpunanKemPeserta' => $dataProviderPerhimpunanKemPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
