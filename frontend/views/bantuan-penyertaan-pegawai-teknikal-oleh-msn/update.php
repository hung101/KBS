<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikalOlehMsn */

$this->title = 'Update Bantuan Penyertaan Pegawai Teknikal Oleh Msn: ' . $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penyertaan Pegawai Teknikal Oleh Msns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id, 'url' => ['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penyertaan-pegawai-teknikal-oleh-msn-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
