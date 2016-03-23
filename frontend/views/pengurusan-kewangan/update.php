<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKewangan */

//$this->title = 'Update Pengurusan Kewangan: ' . ' ' . $model->pengurusan_kewangan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_kewangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kewangan, 'url' => ['view', 'id' => $model->pengurusan_kewangan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kewangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
