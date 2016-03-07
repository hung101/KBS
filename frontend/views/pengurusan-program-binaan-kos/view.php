<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanKos */

$this->title = $model->pengurusan_program_binaan_kos_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Kos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-kos-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_program_binaan_kos_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_program_binaan_kos_id], [
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
            'pengurusan_program_binaan_kos_id',
            'pengurusan_program_binaan_id',
            'kategori_kos',
            'anggaran_kos_per_kategori',
            'revised_kos_per_kategori',
            'approved_kos_per_kategori',
            'catatan',
        ],
    ]);*/ ?>

</div>
