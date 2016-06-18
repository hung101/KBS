<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananDianjurkan */

$this->title = 'Update Bantuan Penganjuran Kejohanan Dianjurkan: ' . $model->bantuan_penganjuran_kejohanan_dianjurkan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Dianjurkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-dianjurkan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
