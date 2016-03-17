<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefReportFormat */

$this->title = 'Update Ref Report Format: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Report Formats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-report-format-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>