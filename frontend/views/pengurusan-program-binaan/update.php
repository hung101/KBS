<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_program_binaan.': ' . ' ' . $model->pengurusan_program_binaan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_program_binaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_program_binaan, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_id]];
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
        'searchModelProgramBinaanTeknikal' => $searchModelProgramBinaanTeknikal,
        'dataProviderProgramBinaanTeknikal' => $dataProviderProgramBinaanTeknikal,
        'searchModelProgramBinaanUrusetia' => $searchModelProgramBinaanUrusetia,
        'dataProviderProgramBinaanUrusetia' => $dataProviderProgramBinaanUrusetia,
        'searchModelPengurusanProgramBinaanAtlet' => $searchModelPengurusanProgramBinaanAtlet,
        'dataProviderPengurusanProgramBinaanAtlet' => $dataProviderPengurusanProgramBinaanAtlet,
        'searchModelPengurusanProgramBinaanJurulatih' => $searchModelPengurusanProgramBinaanJurulatih,
        'dataProviderPengurusanProgramBinaanJurulatih' => $dataProviderPengurusanProgramBinaanJurulatih,
        'searchModelPengurusanProgramBinaanSukan' => $searchModelPengurusanProgramBinaanSukan,
        'dataProviderPengurusanProgramBinaanSukan' => $dataProviderPengurusanProgramBinaanSukan,            'searchModelPengurusanProgramBinaanKategori' => $searchModelPengurusanProgramBinaanKategori,
        'dataProviderPengurusanProgramBinaanKategori' => $dataProviderPengurusanProgramBinaanKategori,
        'readonly' => $readonly,
    ]) ?>

</div>
