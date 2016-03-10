<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefUbat */

$this->title = 'Update Ref Ubat: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Ubats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-ubat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
