<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatihKetua */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_laporan_pemantauan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_laporan_pemantauan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-kategori-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
