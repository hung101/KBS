<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanDonator */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_perubatan_donator.': ' . ' ' . $model->donator_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::donator;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::donator, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::donator, 'url' => ['view', 'id' => $model->donator_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-donator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
