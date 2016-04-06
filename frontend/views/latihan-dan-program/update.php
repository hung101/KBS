<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgram */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::latihan_dan_program.': ' . ' ' . $model->latihan_dan_program_id;
$this->title = GeneralLabel::latihan_dan_pendidikan_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::latihan_dan_pendidikan_badan_sukan, 'url' => ['index']];
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
