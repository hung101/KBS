<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanji */

$this->title = GeneralLabel::pendaftaran_temujanji_baru;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_makmal_perubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-makmal-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
        'dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
        'readonly' => $readonly,
    ]) ?>

</div>
