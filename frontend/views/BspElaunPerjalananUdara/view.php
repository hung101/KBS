<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */

$this->title = $model->bsp_elaun_perjalanan_udara_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Elaun Perjalanan Udaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_elaun_perjalanan_udara_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_elaun_perjalanan_udara_id], [
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
            'bsp_elaun_perjalanan_udara_id',
            'bsp_pemohon_id',
            'tarikh',
            'destinasi_pergi',
            'tarikh_pergi',
            'destinasi_balik',
            'tarikh_balik',
        ],
    ]) ?>

</div>
