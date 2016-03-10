<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPingat */

$this->title = 'Update Ref Pingat: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pingats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pingat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
