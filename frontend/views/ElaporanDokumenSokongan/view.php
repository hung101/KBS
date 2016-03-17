<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanDokumenSokongan */

$this->title = $model->elaporan_dokumen_sokongan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Dokumen Sokongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-dokumen-sokongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->elaporan_dokumen_sokongan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->elaporan_dokumen_sokongan_id], [
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
            'elaporan_dokumen_sokongan_id',
            'elaporan_pelaksaan_id',
            'nama',
            'muat_nail',
        ],
    ]) ?>

</div>
