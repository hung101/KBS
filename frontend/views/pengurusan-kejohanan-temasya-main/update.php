<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKejohananTemasyaMain */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kejohanan_temasya_main.': ' . ' ' . $model->pengurusan_kejohanan_temasya_main_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kejohanan_temasya, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Kejohanan Temasya', 'url' => ['view', 'id' => $model->pengurusan_kejohanan_temasya_main_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kejohanan-temasya-main-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanKejohananTemasya' => $searchModelPengurusanKejohananTemasya,
        'dataProviderPengurusanKejohananTemasya' => $dataProviderPengurusanKejohananTemasya,
        'readonly' => $readonly,
    ]) ?>

</div>
