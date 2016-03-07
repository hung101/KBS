<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaan */

//$this->title = 'Update Pengurusan Program Binaan: ' . ' ' . $model->pengurusan_program_binaan_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Program Binaan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Program Binaan', 'url' => ['view', 'id' => $model->pengurusan_program_binaan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
        'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
        'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
        'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
