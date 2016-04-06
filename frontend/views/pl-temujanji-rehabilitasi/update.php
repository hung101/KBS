<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanjiRehabilitasi */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pl_temujanji.': ' . ' ' . $model->pl_temujanji_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::temujanji_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::temujanji_rehabilitasi, 'url' => ['view', 'id' => $model->pl_temujanji_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
        'dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
        'readonly' => $readonly,
    ]) ?>

</div>
