<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pemantauan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemantauan_jurulatih, 'url' => ['index','jurulatih_id'=>$jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-pemantauan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelLaporanPemantauanJurulatihKategori' => $searchModelLaporanPemantauanJurulatihKategori,
        'dataProviderLaporanPemantauanJurulatihKategori' => $dataProviderLaporanPemantauanJurulatihKategori,
        'readonly' => $readonly,
        'jurulatih_id' => $jurulatih_id,
    ]) ?>

</div>
