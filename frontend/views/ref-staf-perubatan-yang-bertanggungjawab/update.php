<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStafPerubatanYangBertanggungjawab */

$this->title = 'Update Ref Staf Perubatan Yang Bertanggungjawab: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Staf Perubatan Yang Bertanggungjawabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-staf-perubatan-yang-bertanggungjawab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
