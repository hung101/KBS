<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPesertaSukan */

$this->title = $model->penganjuran_kursus_peserta_sukan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus_peserta_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-sukan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->penganjuran_kursus_peserta_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->penganjuran_kursus_peserta_sukan_id], [
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

    <?php
 /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penganjuran_kursus_peserta_sukan_id',
            'penganjuran_kursus_peserta_id',
            'jenis_sukan',
            'tahap',
            'tahun',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
