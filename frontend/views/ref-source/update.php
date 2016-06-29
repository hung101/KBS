<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSource */

$this->title = 'Update Ref Source: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-source-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
