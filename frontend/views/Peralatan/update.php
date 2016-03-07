<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peralatan */

$this->title = 'Update Peralatan: ' . ' ' . $model->peralatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->peralatan_id, 'url' => ['view', 'id' => $model->peralatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peralatan-update">

    <!--<<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
