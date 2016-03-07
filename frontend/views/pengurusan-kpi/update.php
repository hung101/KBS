<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKpi */

//$this->title = 'Update Pengurusan Kpi: ' . ' ' . $model->pengurusan_kpi_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan KPI';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan KPI', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan KPI', 'url' => ['view', 'id' => $model->pengurusan_kpi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kpi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
