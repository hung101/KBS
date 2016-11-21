<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusKhidmatPerubatan */

$this->title = 'Update Ref Status Khidmat Perubatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Khidmat Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-khidmat-perubatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
