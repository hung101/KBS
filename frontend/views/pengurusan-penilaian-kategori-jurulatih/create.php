<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatih */

$this->title = 'Tambah Kategori Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Penilaian Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-kategori-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
