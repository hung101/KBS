<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakanJenisKerosakan */

$this->title = $model->borang_aduan_kerosakan_jenis_kerosakan_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Aduan Kerosakan Jenis Kerosakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kerosakan-jenis-kerosakan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->borang_aduan_kerosakan_jenis_kerosakan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->borang_aduan_kerosakan_jenis_kerosakan_id], [
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
            'borang_aduan_kerosakan_jenis_kerosakan_id',
            'borang_aduan_kerosakan_id',
            'lokasi',
            'jenis_kerosakan',
            'nama_pemeriksa',
            'tarikh_pemeriksaan',
            'kategori_kerosakan',
            'tindakan',
            'catatan',
            'selesai',
            'ulasan_pemeriksa',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
