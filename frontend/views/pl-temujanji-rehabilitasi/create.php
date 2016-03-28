<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanjiRehabilitasi */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
            'dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
        'readonly' => $readonly,
    ]) ?>

</div>
