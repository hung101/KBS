<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentif */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_insentif.': ' . ' ' . $model->pengurusan_insentif_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_insentif, 'url' => ['view', 'id' => $model->pengurusan_insentif_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
