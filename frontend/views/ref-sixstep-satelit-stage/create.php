<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSatelitStage */

$this->title = GeneralLabel::createTitle.' '.'Ref Sixstep Satelit Stage';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Satelit Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-satelit-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
