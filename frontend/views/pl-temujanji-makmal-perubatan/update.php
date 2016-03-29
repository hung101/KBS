<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanji */

//$this->title = 'Update Pl Temujanji: ' . ' ' . $model->pl_temujanji_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::temujanji_makmal_perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_makmal_perubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::temujanji_makmal_perubatan, 'url' => ['view', 'id' => $model->pl_temujanji_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-makmal-perubatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
        'dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
        'readonly' => $readonly,
    ]) ?>

</div>
