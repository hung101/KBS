<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepPsikologiStage */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_psikologi_stage;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_psikologi_stage, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-psikologi-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
