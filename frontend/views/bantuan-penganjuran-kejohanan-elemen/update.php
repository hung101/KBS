<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananElemen */

$this->title = 'Update Bantuan Penganjuran Kejohanan Elemen: ' . $model->bantuan_penganjuran_kejohanan_elemen_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Elemens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_elemen_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_elemen_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-elemen-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
