<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsKejohananProgramAktiviti */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_kejohanan_program_aktiviti.': ' . ' ' . $model->kejohanan_program_aktiviti_id;
$this->title =  'Laporan Aktiviti Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_aktiviti_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->kejohanan_program_aktiviti_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-kejohanan-program-aktiviti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
