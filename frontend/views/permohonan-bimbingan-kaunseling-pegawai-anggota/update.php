<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBimbinganKaunselingPegawaiAnggota */

$this->title = 'Update Permohonan Bimbingan Kaunseling Pegawai Anggota: ' . $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Bimbingan Kaunseling Pegawai Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id, 'url' => ['view', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-bimbingan-kaunseling-pegawai-anggota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
