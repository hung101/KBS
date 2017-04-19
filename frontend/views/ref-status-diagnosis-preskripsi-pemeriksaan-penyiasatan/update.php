<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::status_diagnosis_preskripsi_pemeriksaan_penyiasatan.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_diagnosis_preskripsi_pemeriksaan_penyiasatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-status-diagnosis-preskripsi-pemeriksaan-penyiasatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
