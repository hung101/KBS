<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPengurusanPenginapan */

$this->title = 'Update Ref Pegawai Pengurusan Penginapan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Pengurusan Penginapans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pegawai-pengurusan-penginapan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
