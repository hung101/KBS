<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanVenue */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_venue;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_venue, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-venue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanKemudahanSediaAda' => $searchModelPengurusanKemudahanSediaAda,
        'dataProviderPengurusanKemudahanSediaAda' => $dataProviderPengurusanKemudahanSediaAda,
        'readonly' => $readonly,
    ]) ?>

</div>
