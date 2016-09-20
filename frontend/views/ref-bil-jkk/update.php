<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBilJkk */

$this->title = 'Update Ref Bil Jkk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Bil Jkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-bil-jkk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
