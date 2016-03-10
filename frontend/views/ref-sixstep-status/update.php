<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepStatus */

$this->title = 'Update Ref Sixstep Status: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sixstep-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
