<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaan */

$this->title = GeneralLabel::permohonan_baru;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_program_binaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-create">

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
        'readonly' => $readonly,
    ]) ?>

</div>
