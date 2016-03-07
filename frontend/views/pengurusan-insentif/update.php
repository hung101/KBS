<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentif */

//$this->title = 'Update Pengurusan Insentif: ' . ' ' . $model->pengurusan_insentif_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insentif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Insentif', 'url' => ['view', 'id' => $model->pengurusan_insentif_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
