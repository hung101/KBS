<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenPenyelidikan */

$this->title = 'Update Ref Dokumen Penyelidikan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Dokumen Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-dokumen-penyelidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
