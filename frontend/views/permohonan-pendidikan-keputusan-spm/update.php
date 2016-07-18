<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikanKeputusanSpm */

$this->title = 'Update Permohonan Pendidikan Keputusan Spm: ' . $model->permohonan_pendidikan_keputusan_spm_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan Keputusan Spms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_pendidikan_keputusan_spm_id, 'url' => ['view', 'id' => $model->permohonan_pendidikan_keputusan_spm_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-pendidikan-keputusan-spm-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
