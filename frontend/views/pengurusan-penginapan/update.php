<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenginapan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_penginapan.': ' . ' ' . $model->pengurusan_penginapan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_penginapan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penginapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_penginapan, 'url' => ['view', 'id' => $model->pengurusan_penginapan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penginapan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
