<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanPendapatanTahunLepas */

$this->title = $model->pendapatan_tahun_lepas_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Pendapatan Tahun Lepas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-pendapatan-tahun-lepas-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pendapatan_tahun_lepas_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pendapatan_tahun_lepas_id], [
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
            'pendapatan_tahun_lepas_id',
            'permohonan_e_bantuan_id',
            'jenis_pendapatan',
            'butir_butir',
            'jumlah_pendapatan',
        ],
    ])*/ ?>

</div>
