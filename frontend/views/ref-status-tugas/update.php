<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTugas */

$this->title = 'Update Ref Status Tugas: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Tugas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-tugas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
