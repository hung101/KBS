<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgramPeserta */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::latihan_dan_program_peserta.': ' . ' ' . $model->latihan_dan_program_peserta_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::latihan_dan_program_pesertas, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->latihan_dan_program_peserta_id, 'url' => ['view', 'id' => $model->latihan_dan_program_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="latihan-dan-program-peserta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
