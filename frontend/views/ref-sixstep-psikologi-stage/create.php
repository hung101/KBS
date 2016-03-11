<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepPsikologiStage */

$this->title = 'Create Ref Sixstep Psikologi Stage';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Psikologi Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-psikologi-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
