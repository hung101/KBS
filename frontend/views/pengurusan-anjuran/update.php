<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanAnjuran */

//$this->title = 'Update Pengurusan Anjuran: ' . ' ' . $model->pengurusan_anjuran_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Anjuran';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Anjuran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Anjuran', 'url' => ['view', 'id' => $model->pengurusan_anjuran_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-anjuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
