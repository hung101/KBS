<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */

$this->title = $model->bsp_penjamin_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Penjamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_penjamin_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_penjamin_id], [
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
            'bsp_penjamin_id',
            'bsp_pemohon_id',
            'nama',
            'no_kad_pengenalan',
            'alamat_tetap_1',
            'alamat_tetap_2',
            'alamat_tetap_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'alamat_surat_menyurat_1',
            'alamat_surat_menyurat_2',
            'alamat_surat_menyurat_3',
            'alamat_surat_menyurat_negeri',
            'alamat_surat_menyurat_bandar',
            'alamat_surat_menyurat_poskod',
            'no_telefon_rumah',
            'no_telefon_pejabat',
            'no_telefon_bimbit',
            'email:email',
            'alamat_pejabat_1',
            'alamat_pejabat_2',
            'alamat_pejabat_3',
            'alamat_pejabat_negeri',
            'alamat_pejabat_bandar',
            'alamat_pejabat_poskod',
        ],
    ]) ?>

</div>
