<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepFisiologiStage */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_fisiologi_stage;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_fisiologi_stage, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-fisiologi-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
