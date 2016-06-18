<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananKewangan */

$this->title = 'Update Bantuan Penganjuran Kejohanan Kewangan: ' . $model->bantuan_penganjuran_kejohanan_kewangan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Kewangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_kewangan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_kewangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-kewangan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>


</div>
