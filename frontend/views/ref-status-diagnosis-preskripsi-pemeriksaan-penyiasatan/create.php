<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = 'Create Ref Status Diagnosis Preskripsi Pemeriksaan Penyiasatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Diagnosis Preskripsi Pemeriksaan Penyiasatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-diagnosis-preskripsi-pemeriksaan-penyiasatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
