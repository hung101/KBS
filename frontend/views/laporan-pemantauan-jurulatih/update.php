<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPemantauanDanPenilaianJurulatihKetua */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_pemantauan_dan_penilaian_ketua_jurulatih.': ' . ' ' . $model->pengurusan_pemantauan_dan_penilaian_ketua_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pemantauan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemantauan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle .' '.GeneralLabel::pemantauan_jurulatih, 'url' => ['view', 'id' => $model->laporan_pemantauan_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-pemantauan-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelLaporanPemantauanJurulatihKategori' => $searchModelLaporanPemantauanJurulatihKategori,
        'dataProviderLaporanPemantauanJurulatihKategori' => $dataProviderLaporanPemantauanJurulatihKategori,
        'readonly' => $readonly,
    ]) ?>

</div>
