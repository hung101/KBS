<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bsp */

$this->title = $model->bsp_pemohon_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_pemohon_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_pemohon_id], [
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
            'bsp_pemohon_id',
            'atlet_id',
            'peringkat_pengajian',
            'bidang_pengajian',
            'falkuti_pengajian',
            'ipt',
            'tahun_mula_pengajian',
            'tahun_tamat_pengajian',
            'tahun_ditawarkan_biasiswa',
            'kelulusan',
        ],
    ]) ?>

</div>
