<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSuaianFizikalStage */

$this->title = GeneralLabel::createTitle.' '.'Ref Sixstep Suaian Fizikal Stage';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Suaian Fizikal Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-suaian-fizikal-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
