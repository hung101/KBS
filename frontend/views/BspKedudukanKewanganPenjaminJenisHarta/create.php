<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjaminJenisHarta */

$this->title = 'Tambah Kedudukan Kewangan Penjamin (Jenis Harta)';
$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin (Jenis Harta)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
