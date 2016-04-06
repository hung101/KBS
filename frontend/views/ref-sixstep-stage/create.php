<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepStage */

$this->title = GeneralLabel::createTitle.' '.'Ref Sixstep Stage';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
