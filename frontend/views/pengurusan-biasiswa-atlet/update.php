<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBiasiswaAtlet */

//$this->title = 'Update Pengurusan Biasiswa Atlet: ' . ' ' . $model->pengurusan_biasiswa_atlet_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Biasiswa Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Biasiswa Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Biasiswa Atlet', 'url' => ['view', 'id' => $model->pengurusan_biasiswa_atlet_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-biasiswa-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
