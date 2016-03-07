<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKewanganDanPerbelanjaan */

$this->title = 'Update Elaporan Kewangan Dan Perbelanjaan: ' . ' ' . $model->elaporan_kewangan_dan_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Kewangan Dan Perbelanjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_kewangan_dan_perbelanjaan_id, 'url' => ['view', 'id' => $model->elaporan_kewangan_dan_perbelanjaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-kewangan-dan-perbelanjaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
