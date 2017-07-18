<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananElemen */

$this->title = $model->bantuan_penyertaan_pegawai_teknikal_elemen_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Elemens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-elemen-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_elemen_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_elemen_id], [
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
            'bantuan_penyertaan_pegawai_teknikal_elemen_id',
            'bantuan_penganjuran_kejohanan_id',
            'elemen_bantuan',
            'sub_elemen',
            'kadar',
            'bilangan',
            'hari',
            'jumlah',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
