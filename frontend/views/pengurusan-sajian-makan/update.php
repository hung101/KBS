<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSajianMakan */

//$this->title = 'Update Pengurusan Sajian Makan: ' . ' ' . $model->pengurusan_sajian_makan_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Sajian Makan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Sajian Makan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Sajian Makan', 'url' => ['view', 'id' => $model->pengurusan_sajian_makan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-sajian-makan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
