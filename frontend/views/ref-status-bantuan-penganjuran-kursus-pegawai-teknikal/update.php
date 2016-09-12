<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenganjuranKursusPegawaiTeknikal */

$this->title = 'Update Ref Status Bantuan Penganjuran Kursus Pegawai Teknikal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penganjuran Kursus Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-bantuan-penganjuran-kursus-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
