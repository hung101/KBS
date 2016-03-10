<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepFisiologiStage */

$this->title = 'Create Ref Sixstep Fisiologi Stage';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Fisiologi Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-fisiologi-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
