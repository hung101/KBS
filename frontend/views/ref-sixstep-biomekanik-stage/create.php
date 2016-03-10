<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepBiomekanikStage */

$this->title = 'Create Ref Sixstep Biomekanik Stage';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Biomekanik Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-biomekanik-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
