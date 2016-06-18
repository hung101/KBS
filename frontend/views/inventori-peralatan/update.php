<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventoriPeralatan */

$this->title = 'Update Inventori Peralatan: ' . $model->inventori_peralatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Inventori Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inventori_peralatan_id, 'url' => ['view', 'id' => $model->inventori_peralatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventori-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
