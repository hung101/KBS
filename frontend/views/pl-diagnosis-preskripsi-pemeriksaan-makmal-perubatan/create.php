<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlDiagnosisPreskripsiPemeriksaan */

$this->title = 'Tambah Diagnosis/Preskripsi/Pemeriksaan/Penyiasatan';
$this->params['breadcrumbs'][] = ['label' => 'Diagnosis/Preskripsi/Pemeriksaan/Penyiasatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-diagnosis-preskripsi-pemeriksaan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
