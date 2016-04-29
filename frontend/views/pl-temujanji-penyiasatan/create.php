<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanji */

$this->title =  GeneralLabel::pendaftaran_temujanji;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_penyiasatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-penyiasatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
        'dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
        'readonly' => $readonly,
    ]) ?>

</div>
