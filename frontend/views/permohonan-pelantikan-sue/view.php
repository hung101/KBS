<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPelantikanSue */

$this->title = $model->permohonan_pelantikan_sue_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pelantikan Sues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pelantikan-sue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->permohonan_pelantikan_sue_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->permohonan_pelantikan_sue_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_pelantikan_sue_id',
            'nama_sue',
            'no_kad_pengenalan',
            'emel',
            'jumlah_dipohon',
            'nama_persatuan',
            'tarikh_mula_khidmat',
            'sehingga',
            'muatnaik',
            'status_permohonan',
            'catatan',
            'tarikh_dipohon',
            'jumlah_diluluskan',
            'tarikh_kelulusan_jkb',
            'bilangan_jkb',
            'tarikh_lantikan',
            'tarikh_tamat_lantikan',
            'tempoh',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
