<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPengurusanStok */

$this->title = $model->farmasi_pengurusan_stok;
$this->params['breadcrumbs'][] = ['label' => 'Farmasi Pengurusan Stoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-pengurusan-stok-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->farmasi_pengurusan_stok], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->farmasi_pengurusan_stok], [
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
            'farmasi_pengurusan_stok',
            'nama_ubat',
            'dos',
            'harga',
            'kuantiti',
            'jumlah_harga',
        ],
    ]) ?>

</div>
