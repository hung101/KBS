<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBimbinganKaunselingPegawaiAnggota */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_bimbingan_kaunseling_pegawai_anggota;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_bimbingan_kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-bimbingan-kaunseling-pegawai-anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
