<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = 'Update Ref Status Diagnosis Preskripsi Pemeriksaan Penyiasatan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Diagnosis Preskripsi Pemeriksaan Penyiasatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-diagnosis-preskripsi-pemeriksaan-penyiasatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
