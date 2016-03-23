<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanji */

//$this->title = 'Update Pl Temujanji: ' . ' ' . $model->pl_temujanji_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::temujanji;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::temujanji, 'url' => ['view', 'id' => $model->pl_temujanji_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
        'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
        'readonly' => $readonly,
    ]) ?>

</div>
