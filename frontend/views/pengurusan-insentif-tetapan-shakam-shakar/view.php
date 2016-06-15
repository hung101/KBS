<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentifTetapanShakamShakar */

$this->title = $model->pengurusan_insentif_tetapan_shakam_shakar_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insentif Tetapan Shakam Shakars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-tetapan-shakam-shakar-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_insentif_tetapan_shakam_shakar_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_insentif_tetapan_shakam_shakar_id], [
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
            'pengurusan_insentif_tetapan_shakam_shakar_id',
            'pengurusan_insentif_tetapan_id',
            'jenis_insentif',
            'pingat',
            'kumpulan_temasya_kejohanan',
            'rekod_baharu',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
