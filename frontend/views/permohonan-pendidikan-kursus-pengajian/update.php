<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikanKursusPengajian */

$this->title = 'Update Permohonan Pendidikan Kursus Pengajian: ' . $model->permohonan_pendidikan_kursus_pengajian_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan Kursus Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_pendidikan_kursus_pengajian_id, 'url' => ['view', 'id' => $model->permohonan_pendidikan_kursus_pengajian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-pendidikan-kursus-pengajian-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
