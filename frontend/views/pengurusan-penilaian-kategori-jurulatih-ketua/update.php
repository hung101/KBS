<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatihKetua */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_penilaian_kategori_jurulatih.': ' . ' ' . $model->pengurusan_penilaian_kategori_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penilaian_kategori_jurulatihs, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_penilaian_kategori_jurulatih_id, 'url' => ['view', 'id' => $model->pengurusan_penilaian_kategori_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-penilaian-kategori-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
