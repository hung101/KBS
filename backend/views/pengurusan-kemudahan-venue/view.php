<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanVenue */

//$this->title = $model->pengurusan_kemudahan_venue_id;
$this->title = GeneralLabel::viewTitle . ' Iklan';
//$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Venue', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-venue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kemudahan_venue_id], ['class' => 'btn btn-primary']) ?>
            <!--<?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kemudahan_venue_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>-->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanKemudahanSediaAda' => $searchModelPengurusanKemudahanSediaAda,
        'dataProviderPengurusanKemudahanSediaAda' => $dataProviderPengurusanKemudahanSediaAda,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_kemudahan_venue_id',
            'nama_venue',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'no_faks',
            'pemilik',
            'sewaan',
            'status',
        ],
    ]);*/ ?>

</div>
