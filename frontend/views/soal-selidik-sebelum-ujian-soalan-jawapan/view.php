<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjianSoalanJawapan */

$this->title = $model->soal_selidik_sebelum_ujian_soalan_jawapan_id;
$this->params['breadcrumbs'][] = ['label' => 'Soal Selidik Sebelum Ujian Soalan Jawapans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-soalan-jawapan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id], [
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
            'soal_selidik_sebelum_ujian_soalan_jawapan_id',
            'soal_selidik_sebelum_ujian_id',
            'soalan',
            'jawapan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
