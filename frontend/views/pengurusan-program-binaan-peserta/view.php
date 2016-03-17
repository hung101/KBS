<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanPeserta */

$this->title = $model->pengurusan_program_binaan_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-peserta-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_program_binaan_peserta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_program_binaan_peserta_id], [
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
            'pengurusan_program_binaan_peserta_id',
            'pengurusan_program_binaan_id',
            'kategori_peserta',
            'atlet_jurulatih',
            'nama_peserta',
            'jantina',
        ],
    ]);*/ ?>

</div>
