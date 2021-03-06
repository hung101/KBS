<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKewangan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kewangan_hpt.': ' . ' ' . $model->pengurusan_kewangan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_kewangan_hpt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kewangan_hpt, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kewangan_hpt, 'url' => ['view', 'id' => $model->pengurusan_kewangan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kewangan-hpt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
