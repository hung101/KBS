<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

$this->title = $model->bsp_tamat_pengesahan_pengajian_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Tamat Pengesahan Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_tamat_pengesahan_pengajian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_tamat_pengesahan_pengajian_id], [
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
            'bsp_tamat_pengesahan_pengajian_id',
            'nama_ipts',
            'pengajian',
            'bidang',
            'cgpa_pngk',
            'tarikh_tamat',
        ],
    ]) ?>

</div>
