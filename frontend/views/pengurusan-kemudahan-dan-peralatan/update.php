<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanDanPeralatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kemudahan_dan_peralatan.': ' . ' ' . $model->pengurusan_kemudahan_dan_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_kemudahan_dan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_dan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kemudahan_dan_peralatan, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_dan_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-dan-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
