<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikalKejohanan */

$this->title = 'Update Maklumat Pegawai Teknikal Kejohanan: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Pegawai Teknikal Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maklumat-pegawai-teknikal-kejohanan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
