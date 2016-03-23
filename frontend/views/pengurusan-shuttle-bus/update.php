<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanShuttleBus */

//$this->title = 'Update Pengurusan Shuttle Bus: ' . ' ' . $model->pengurusan_shuttle_bus_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_pengangkutan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_pengangkutan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_pengangkutan, 'url' => ['view', 'id' => $model->pengurusan_shuttle_bus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-shuttle-bus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
