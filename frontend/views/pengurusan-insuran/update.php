<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuran */

//$this->title = 'Update Pengurusan Insuran: ' . ' ' . $model->pengurusan_insuran_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Insurans';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Insurans', 'url' => ['view', 'id' => $model->pengurusan_insuran_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="pengurusan-insuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
