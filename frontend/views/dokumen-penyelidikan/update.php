<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DokumenPenyelidikan */

$this->title = 'Update Dokumen Penyelidikan: ' . ' ' . $model->dokumen_penyelidikan_id;
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dokumen_penyelidikan_id, 'url' => ['view', 'id' => $model->dokumen_penyelidikan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dokumen-penyelidikan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
