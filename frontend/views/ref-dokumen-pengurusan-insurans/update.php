<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenPengurusanInsurans */

$this->title = 'Update Dokumen Pengurusan Insurans: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Pengurusan Insurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-dokumen-pengurusan-insurans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
