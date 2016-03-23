<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanji */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
        'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
        'readonly' => $readonly,
    ]) ?>

</div>
