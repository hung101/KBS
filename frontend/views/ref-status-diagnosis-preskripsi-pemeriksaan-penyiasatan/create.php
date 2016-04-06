<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_diagnosis_preskripsi_pemeriksaan_penyiasatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_diagnosis_preskripsi_pemeriksaan_penyiasatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-diagnosis-preskripsi-pemeriksaan-penyiasatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
