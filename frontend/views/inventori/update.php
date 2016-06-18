<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventori */

$this->title = 'Update Inventori: ' . $model->inventori_id;
$this->params['breadcrumbs'][] = ['label' => 'Inventoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inventori_id, 'url' => ['view', 'id' => $model->inventori_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventori-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
