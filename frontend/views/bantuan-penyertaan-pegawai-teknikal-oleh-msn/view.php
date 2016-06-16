<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikalOlehMsn */

$this->title = $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penyertaan Pegawai Teknikal Oleh Msns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-oleh-msn-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penyertaan_pegawai_teknikal_oleh_msn_id',
            'bantuan_penyertaan_pegawai_teknikal_id',
            'kejohanan',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'status_penganjuran',
            'jumlah_bantuan',
            'laporan_dikemukakan',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
