<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKejohananTemasya */

//$this->title = 'Update Pengurusan Kejohanan Temasya: ' . ' ' . $model->pengurusan_kejohanan_temasya_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kejohanan Temasya', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Kejohanan Temasya', 'url' => ['view', 'id' => $model->pengurusan_kejohanan_temasya_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kejohanan-temasya-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
