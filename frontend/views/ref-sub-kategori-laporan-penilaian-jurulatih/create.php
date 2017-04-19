<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubKategoriPenilaianJurulatihKetua */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sub_kategori_laporan_penilaian_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sub_kategori_laporan_penilaian_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-kategori-penilaian-jurulatih-ketua-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
