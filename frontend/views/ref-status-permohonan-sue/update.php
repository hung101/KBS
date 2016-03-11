<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanSue */

$this->title = 'Update Ref Status Permohonan Sue: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Sues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-permohonan-sue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
