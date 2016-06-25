<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAjk */

$this->title = 'Update Ref Ajk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Ajks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-ajk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
