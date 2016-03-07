<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPemantauanDanPenilaianJurulatih */

$this->title = GeneralLabel::createTitle . ' Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPenilaianKategoriJurulatih' => $searchModelPengurusanPenilaianKategoriJurulatih,
        'dataProviderPengurusanPenilaianKategoriJurulatih' => $dataProviderPengurusanPenilaianKategoriJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>
