<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepPsikologiStatus */

$this->title = GeneralLabel::createTitle.' '.'Ref Sixstep Psikologi Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sixstep Psikologi Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-psikologi-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
