<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPengurusanKemudahan */

$this->title = 'Update Ref Status Pengurusan Kemudahan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Pengurusan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-pengurusan-kemudahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
