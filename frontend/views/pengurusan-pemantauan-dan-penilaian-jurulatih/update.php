<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPemantauanDanPenilaianJurulatih */

//$this->title = 'Update Pengurusan Pemantauan Dan Penilaian Jurulatih: ' . ' ' . $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penilaian Jurulatih', 'url' => ['view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPenilaianKategoriJurulatih' => $searchModelPengurusanPenilaianKategoriJurulatih,
        'dataProviderPengurusanPenilaianKategoriJurulatih' => $dataProviderPengurusanPenilaianKategoriJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>
