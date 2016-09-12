<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPemantauanDanPenilaianJurulatihKetua */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penilaian_ketua_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_ketua_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPenilaianKategoriJurulatihKetua' => $searchModelPengurusanPenilaianKategoriJurulatihKetua,
        'dataProviderPengurusanPenilaianKategoriJurulatihKetua' => $dataProviderPengurusanPenilaianKategoriJurulatihKetua,
        'readonly' => $readonly,
    ]) ?>

</div>
