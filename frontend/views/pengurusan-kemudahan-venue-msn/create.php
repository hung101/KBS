<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanVenue */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::senarai_venue_profil;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_venue_profil, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-venue-msn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanKemudahanSediaAdaMsn' => $searchModelPengurusanKemudahanSediaAdaMsn,
        'dataProviderPengurusanKemudahanSediaAdaMsn' => $dataProviderPengurusanKemudahanSediaAdaMsn,
        'readonly' => $readonly,
    ]) ?>

</div>
