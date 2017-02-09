<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjaminJenisHarta */

$this->title = $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Kedudukan Kewangan Penjamin Jenis Hartas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id], [
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
            'bsp_kedudukan_kewangan_penjamin_jenis_harta_id',
            'bsp_kedudukan_kewangan_penjamin_id',
            'jenis_harta',
            'jumlah_ekar_kaki_persegi',
            'nilai',
        ],
    ]) ?>

</div>
