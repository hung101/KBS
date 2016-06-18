<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikal */

$this->title = 'Update Maklumat Pegawai Teknikal: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maklumat-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
