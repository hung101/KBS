<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananLaporanTuntutan */

$this->title = 'Create Bantuan Penganjuran Kejohanan Laporan Tuntutan';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Laporan Tuntutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-sirkit-laporan-tuntutan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
