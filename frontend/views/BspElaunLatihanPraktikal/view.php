<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */

$this->title = $model->bsp_elaun_latihan_praktikal_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Elaun Latihan Praktikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_elaun_latihan_praktikal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_elaun_latihan_praktikal_id], [
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
            'bsp_elaun_latihan_praktikal_id',
            'bsp_pemohon_id',
            'tarikh',
            'jenis_latihan_amali',
            'tempat_latihan_praktikal',
            'tarikh_mula',
            'tarikh_tamat',
            'jumlah_hari',
        ],
    ]) ?>

</div>
