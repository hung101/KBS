<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatihKetua */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kategori_laporan_pemantauan_jurulatih.': ' . ' ' . $model->laporan_pemantauan_jurulatih_kategori_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_laporan_pemantauan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->laporan_pemantauan_jurulatih_kategori_id, 'url' => ['view', 'id' => $model->laporan_pemantauan_jurulatih_kategori_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-penilaian-kategori-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
