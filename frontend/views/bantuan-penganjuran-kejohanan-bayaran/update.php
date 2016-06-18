<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananBayaran */

$this->title = 'Update Bantuan Penganjuran Kejohanan Bayaran: ' . $model->bantuan_penganjuran_kejohanan_bayaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Bayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_bayaran_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_bayaran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-bayaran-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
