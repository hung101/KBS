<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pl_diagnosis_preskripsi_pemeriksaan.': ' . ' ' . $model->pl_diagnosis_preskripsi_pemeriksaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pl_diagnosis_preskripsi_pemeriksaans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pl_diagnosis_preskripsi_pemeriksaan_id, 'url' => ['view', 'id' => $model->pl_diagnosis_preskripsi_pemeriksaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pl-diagnosis-preskripsi-pemeriksaan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
