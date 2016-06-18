<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenginapanAtlet */

$this->title = 'Update Pengurusan Penginapan Atlet: ' . $model->pengurusan_penginapan_atlet_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Penginapan Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_penginapan_atlet_id, 'url' => ['view', 'id' => $model->pengurusan_penginapan_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-penginapan-atlet-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
