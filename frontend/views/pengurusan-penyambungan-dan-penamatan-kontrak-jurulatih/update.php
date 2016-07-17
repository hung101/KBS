<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih.': ' . ' ' . $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pelanjutan_dan_penamatan_kontrak_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelanjutan_dan_penamatan_kontrak_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pelanjutan_dan_penamatan_kontrak_jurulatih, 'url' => ['view', 'id' => $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
