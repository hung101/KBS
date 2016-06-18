<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananLaporanTuntutan */

$this->title = 'Update Bantuan Penganjuran Kejohanan Laporan Tuntutan: ' . $model->bantuan_penganjuran_kejohanan_laporan_tuntutan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Laporan Tuntutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_laporan_tuntutan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_tuntutan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-laporan-tuntutan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
