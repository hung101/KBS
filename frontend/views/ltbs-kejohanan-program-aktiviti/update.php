<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsKejohananProgramAktiviti */

//$this->title = 'Update Ltbs Kejohanan Program Aktiviti: ' . ' ' . $model->kejohanan_program_aktiviti_id;
$this->title =  'Laporan Aktiviti Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Aktiviti Badan Sukan', 'url' => ['index']];
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
