<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ekemudahan */

$this->title = $model->ekemudahan_id;
$this->params['breadcrumbs'][] = ['label' => 'Ekemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ekemudahan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ekemudahan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ekemudahan_id], [
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
            'ekemudahan_id',
            'kategori',
            'jenis',
            'gambar',
            'lokasi',
            'dihubungi',
            'kadar_sewa',
            'url:url',
            'nama_perniagaan_perkhidmatan_organisasi',
            'kapasiti_penggunaan',
            'no_lesen_pendaftaran',
        ],
    ]) ?>

</div>
