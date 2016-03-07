<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanDanPeralatan */

//$this->title = 'Update Pengurusan Kemudahan Dan Peralatan: ' . ' ' . $model->pengurusan_kemudahan_dan_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Kemudahan Dan Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan Dan Peralatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Kemudahan Dan Peralatan', 'url' => ['view', 'id' => $model->pengurusan_kemudahan_dan_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-dan-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
