<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanAnjuranNegara */

$this->title = 'Update Pengurusan Anjuran Negara: ' . $model->pengurusan_anjuran_negara_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Anjuran Negaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_anjuran_negara_id, 'url' => ['view', 'id' => $model->pengurusan_anjuran_negara_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-anjuran-negara-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
