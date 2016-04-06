<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPermohonanPemakanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_permohonan_pemakanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_permohonan_pemakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-permohonan-pemakanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
