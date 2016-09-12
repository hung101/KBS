<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAcaraInsentif */

$this->title = 'Update Ref Acara Insentif: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Acara Insentifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-acara-insentif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
