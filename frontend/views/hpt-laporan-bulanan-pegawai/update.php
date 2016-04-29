<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\HptLaporanBulananPegawai */

//$this->title = 'Update Hpt Laporan Bulanan Pegawai: ' . ' ' . $model->hpt_laporan_bulanan_pegawai_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::hpt_laporan_bulanan_pegawai;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hpt_laporan_bulanan_pegawai, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::hpt_laporan_bulanan_pegawai, 'url' => ['view', 'id' => $model->hpt_laporan_bulanan_pegawai_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpt-laporan-bulanan-pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
