<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPengurusanStok */

$this->title = 'Update Farmasi Pengurusan Stok: ' . ' ' . $model->farmasi_pengurusan_stok;
$this->params['breadcrumbs'][] = ['label' => 'Farmasi Pengurusan Stoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->farmasi_pengurusan_stok, 'url' => ['view', 'id' => $model->farmasi_pengurusan_stok]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="farmasi-pengurusan-stok-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
