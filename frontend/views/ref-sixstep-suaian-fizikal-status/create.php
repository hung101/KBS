<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepSuaianFizikalStatus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_suaian_fizikal_status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_suaian_fizikal_statuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-suaian-fizikal-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
