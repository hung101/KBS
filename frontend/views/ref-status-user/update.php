<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusUser */

$this->title = 'Update Ref Status User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
