<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgram */

//$this->title = 'Update Latihan Dan Program: ' . ' ' . $model->latihan_dan_program_id;
$this->title =  'Latihan Dan Pendidikan Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Latihan Dan Pendidikan Badan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->latihan_dan_program_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="latihan-dan-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPeserta' => $searchModelPeserta,
        'dataProviderPeserta' => $dataProviderPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
