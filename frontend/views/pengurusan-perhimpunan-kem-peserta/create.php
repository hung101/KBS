<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKemPeserta */

$this->title = 'Tambah Pengurusan Perhimpunan/Kem Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Perhimpunan/Kem Peserta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhimpunan-kem-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
