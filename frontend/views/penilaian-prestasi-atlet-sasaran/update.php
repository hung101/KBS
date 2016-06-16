<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtletSasaran */

$this->title = 'Update Penilaian Prestasi Atlet Sasaran: ' . $model->penilaian_prestasi_atlet_sasaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Atlet Sasarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penilaian_prestasi_atlet_sasaran_id, 'url' => ['view', 'id' => $model->penilaian_prestasi_atlet_sasaran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penilaian-prestasi-atlet-sasaran-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
