<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanPenilaianPendidikanPenganjur */

$this->title = 'Update Pengurusan Soalan Penilaian Pendidikan Penganjur: ' . ' ' . $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Soalan Penilaian Pendidikan Penganjurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id, 'url' => ['view', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-soalan-penilaian-pendidikan-penganjur-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
