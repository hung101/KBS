<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanAtlet */

$this->title = 'Update Pengurusan Program Binaan Kategori: ' . $model->pengurusan_program_binaan_kategori_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_binaan_kategori_id, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_kategori_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-sukan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
