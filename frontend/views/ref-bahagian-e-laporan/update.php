<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianELaporan */

$this->title = 'Update Ref Bahagian Elaporan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-bahagian-elaporan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
