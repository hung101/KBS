<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkan */

$this->title = 'Update Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkan: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-dicadangkan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
