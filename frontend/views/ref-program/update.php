<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

$this->title = 'Update Ref Program: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
