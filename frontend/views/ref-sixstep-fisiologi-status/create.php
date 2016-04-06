<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepFisiologiStatus */

$this->title = GeneralLabel::createTitle.' '.'Ref Sixstep Fisiologi Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Fisiologi Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-fisiologi-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
