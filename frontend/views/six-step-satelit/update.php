<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SixStepSatelit */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::six_step.': ' . ' ' . $model->six_step_id;
$this->title = GeneralLabel::updateTitle . ' Six Step';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::satelit, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Six Step', 'url' => ['view', 'id' => $model->six_step_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="six-step-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
