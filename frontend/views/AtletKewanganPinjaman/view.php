<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganPinjaman */

$this->title = $model->pinjaman_id;
$this->params['breadcrumbs'][] = ['label' => 'Atlet Kewangan Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-pinjaman-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pinjaman_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pinjaman_id], [
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
            'pinjaman_id',
            'atlet_id',
            'nama_bank',
            'jenis_pinjaman',
            'no_akaun',
            'nilai_pinjaman',
            'tahun_pinjaman',
            'tahun_permulaan',
        ],
    ]) ?>

</div>
