<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuranLampiran */

$this->title = 'Update Pengurusan Insuran Lampiran: ' . $model->geran_bantuan_gaji_lampiran_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insuran Lampirans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->geran_bantuan_gaji_lampiran_id, 'url' => ['view', 'id' => $model->geran_bantuan_gaji_lampiran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-insuran-lampiran-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
