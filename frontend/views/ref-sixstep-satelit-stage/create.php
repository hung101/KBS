<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSatelitStage */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_satelit_stage;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_satelit_stage, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-satelit-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
