<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubKategoriPenilaianJurulatihKetua */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sub Kategori Laporan Penilaian Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-kategori-penilaian-jurulatih-ketua-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'ref_kategori_laporan_penilaian_jurulatih_id',
            'desc',
            'aktif',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]) ?>

</div>
