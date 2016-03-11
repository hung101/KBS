<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = 'Create Ref Unit Diagnosis Preskripsi Pemeriksaan Penyiasatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Unit Diagnosis Preskripsi Pemeriksaan Penyiasatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-unit-diagnosis-preskripsi-pemeriksaan-penyiasatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
