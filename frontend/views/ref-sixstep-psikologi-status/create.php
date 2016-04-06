<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepPsikologiStatus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_psikologi_status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_psikologi_statuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-psikologi-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
