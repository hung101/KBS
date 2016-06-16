<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPenceramah */

$this->title = 'Update Bantuan Penganjuran Kursus Penceramah: ' . $model->bantuan_penganjuran_kursus_penceramah_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Penceramahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_penceramah_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_penceramah_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kursus-penceramah-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
