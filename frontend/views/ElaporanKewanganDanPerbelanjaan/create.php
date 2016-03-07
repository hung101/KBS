<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKewanganDanPerbelanjaan */

$this->title = 'Tambah e-Laporan Kewangan Dan Perbelanjaan';
$this->params['breadcrumbs'][] = ['label' => 'e-Laporan Kewangan Dan Perbelanjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-kewangan-dan-perbelanjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
