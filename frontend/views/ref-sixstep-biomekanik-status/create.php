<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSixstepBiomekanikStatus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sixstep_biomekanik_status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sixstep_biomekanik_statuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-biomekanik-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
