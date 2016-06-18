<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohanan */

$this->title = 'Update Bantuan Penganjuran Kejohanan: ' . $model->bantuan_penganjuran_kejohanan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
        'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
        'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
        'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
        'readonly' => $readonly,
    ]) ?>

</div>
