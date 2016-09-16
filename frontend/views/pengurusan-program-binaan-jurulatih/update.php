<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanJurulatih */

$this->title = 'Update Pengurusan Program Binaan Jurulatih: ' . $model->pengurusan_program_binaan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_binaan_jurulatih_id, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
