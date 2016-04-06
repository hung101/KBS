<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepStage */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_stage;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_stage, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
