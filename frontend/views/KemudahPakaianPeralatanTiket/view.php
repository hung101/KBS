<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KemudahPakaianPeralatanTiket */

$this->title = $model->kemudah_pakaian_peralatan_tiket_id;
$this->params['breadcrumbs'][] = ['label' => 'Kemudah Pakaian Peralatan Tikets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kemudah-pakaian-peralatan-tiket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kemudah_pakaian_peralatan_tiket_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kemudah_pakaian_peralatan_tiket_id], [
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
            'kemudah_pakaian_peralatan_tiket_id',
            'atlet_id',
            'kategori_permohonan',
            'tarikh_diperlukan_pergi',
            'tarikh_dijangka_dipulangkan_balik',
            'destinasi_daripada',
            'destinasi_ke',
            'ulasan_permohonan',
            'kelulusan',
        ],
    ]) ?>

</div>
