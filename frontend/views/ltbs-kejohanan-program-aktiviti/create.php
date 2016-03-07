<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsKejohananProgramAktiviti */

$this->title = 'Laporan Aktiviti Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Aktiviti Badan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-kejohanan-program-aktiviti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
