<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanPendapatanTahunLepas */

$this->title = 'Tambah Pendapatan Tahun Lepas';
$this->params['breadcrumbs'][] = ['label' => 'Pendapatan Tahun Lepas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-pendapatan-tahun-lepas-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
