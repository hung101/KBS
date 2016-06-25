<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPenganjurJkk */

$this->title = 'Update Ref Penganjur Jkk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Penganjur Jkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-penganjur-jkk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
