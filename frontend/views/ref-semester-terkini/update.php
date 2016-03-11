<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSemesterTerkini */

$this->title = 'Update Ref Semester Terkini: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Semester Terkinis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-semester-terkini-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
