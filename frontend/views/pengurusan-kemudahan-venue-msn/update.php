<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanVenue */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kemudahan_venue.': ' . ' ' . $model->pengurusan_kemudahan_venue_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::senarai_venue_profil;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_venue_profil, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::senarai_venue_profil, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_venue_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-venue-msn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanKemudahanSediaAdaMsn' => $searchModelPengurusanKemudahanSediaAdaMsn,
        'dataProviderPengurusanKemudahanSediaAdaMsn' => $dataProviderPengurusanKemudahanSediaAdaMsn,
        'readonly' => $readonly,
    ]) ?>

</div>
