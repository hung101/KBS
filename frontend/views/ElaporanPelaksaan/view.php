<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = $model->elaporan_pelaksaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->elaporan_pelaksaan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->elaporan_pelaksaan_id], [
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
            'elaporan_pelaksaan_id',
            'nama_projek_program_aktiviti_kejohanan',
            'nama_persatuan',
            'jumlah_bantuan',
            'no_cek_eft',
            'tarikh_cek_eft',
            'objektif_pelaksaan',
            'tarikh_dilaksanakan',
            'tempat',
            'dirasmikan_oleh',
            'jumlah_penyertaan_keseluruhan',
            'keberkesanan_pelaksaan',
        ],
    ]) ?>

</div>
