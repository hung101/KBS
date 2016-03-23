<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanVenue */

//$this->title = 'Update Pengurusan Kemudahan Venue: ' . ' ' . $model->pengurusan_kemudahan_venue_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_venue;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_venue, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_venue, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_venue_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-venue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanKemudahanSediaAda' => $searchModelPengurusanKemudahanSediaAda,
        'dataProviderPengurusanKemudahanSediaAda' => $dataProviderPengurusanKemudahanSediaAda,
        'readonly' => $readonly,
    ]) ?>

</div>
