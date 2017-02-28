<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LaporanPenyertaanKejohananPegawai */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_program_binaan_teknikal.': ' . ' ' . $model->laporan_penyertaan_kejohanan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->laporan_penyertaan_kejohanan_jurulatih_id, 'url' => ['view', 'id' => $model->laporan_penyertaan_kejohanan_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-teknikal-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
