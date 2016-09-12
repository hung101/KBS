<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPemantauanDanPenilaianJurulatihKetua */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_pemantauan_dan_penilaian_ketua_jurulatih.': ' . ' ' . $model->pengurusan_pemantauan_dan_penilaian_ketua_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penilaian_ketua_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_ketua_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penilaian Jurulatih', 'url' => ['view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPenilaianKategoriJurulatihKetua' => $searchModelPengurusanPenilaianKategoriJurulatihKetua,
        'dataProviderPengurusanPenilaianKategoriJurulatihKetua' => $dataProviderPengurusanPenilaianKategoriJurulatihKetua,
        'readonly' => $readonly,
    ]) ?>

</div>
