<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSilibus */

$this->title = 'Update Ref Silibus: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Silibuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-silibus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>