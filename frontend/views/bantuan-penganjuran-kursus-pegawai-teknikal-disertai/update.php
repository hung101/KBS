<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalDisertai */

$this->title = 'Update Bantuan Penganjuran Kursus Pegawai Teknikal Disertai: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_disertai_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Disertais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_disertai_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_disertai_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-disertai-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
