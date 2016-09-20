<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan */

$this->title = 'Update Bantuan Penyertaan Pegawai Teknikal Dicadangkan: ' . $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penyertaan Pegawai Teknikal Dicadangkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id, 'url' => ['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penyertaan-pegawai-teknikal-dicadangkan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
