<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */

$this->title = $model->bsp_kedudukan_kewangan_penjamin_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Kedudukan Kewangan Penjamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_kedudukan_kewangan_penjamin_id',
            'bsp_penjamin_id',
            'pendapatan_bulanan',
            'pinjaman_perumahan_baki_terkini',
            'sebagai_penjamin_siberhutang',
            'lain_lain_pinjaman_tanggungan',
            'perkerjaan',
            'nama_alamat_majikan',
            'nama_isteri_suami',
            'no_kp_isteri_suami',
            'jumlah_anak',
            'pertalian_keluarga_dengan_pelajar',
            'pelajar_lain_selain_daripada_penerima_di_atas',
        ],
    ]) ?>

</div>
