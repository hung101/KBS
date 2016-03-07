<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianPendidikanPenganjurIntructor */

//$this->title = 'Update Pengurusan Penilaian Pendidikan Penganjur Intructor: ' . ' ' . $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Penilaian Pendidikan Penganjur/Intructor';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Penilaian Pendidikan Penganjur/Intructor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Penilaian Pendidikan Penganjur/Intructor', 'url' => ['view', 'id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-pendidikan-penganjur-intructor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanSoalanPenilaianPendidikan' => $searchModelPengurusanSoalanPenilaianPendidikan,
        'dataProviderPengurusanSoalanPenilaianPendidikan' => $dataProviderPengurusanSoalanPenilaianPendidikan,
        'readonly' => $readonly,
    ]) ?>

</div>
