<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanShuttleBus */

//$this->title = 'Update Pengurusan Shuttle Bus: ' . ' ' . $model->pengurusan_shuttle_bus_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Pengangkutan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Pengangkutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Pengangkutan', 'url' => ['view', 'id' => $model->pengurusan_shuttle_bus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-shuttle-bus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
