<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPenilaianPeserta */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Penilaian Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Penilaian Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-penilaian-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
