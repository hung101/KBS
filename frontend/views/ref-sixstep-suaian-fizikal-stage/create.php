<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSuaianFizikalStage */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_suaian_fizikal_stage;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_suaian_fizikal_stage, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-suaian-fizikal-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
