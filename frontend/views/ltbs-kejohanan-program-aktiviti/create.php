<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsKejohananProgramAktiviti */

$this->title = GeneralLabel::laporan_aktiviti_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_aktiviti_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-kejohanan-program-aktiviti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
