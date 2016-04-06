<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepStatus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_statuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
