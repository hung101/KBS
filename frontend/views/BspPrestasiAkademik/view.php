<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiAkademik */

$this->title = $model->bsp_prestasi_akademik_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Prestasi Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_prestasi_akademik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_prestasi_akademik_id], [
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
            'bsp_prestasi_akademik_id',
            'bsp_pemohon_id',
            'tarikh',
            'png',
            'pngk',
        ],
    ]) ?>

</div>
