<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuanPenasihat */

$this->title = $model->pengurusan_permohonan_kursus_persatuan_penasihat_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Permohonan Kursus Persatuan Penasihats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-kursus-persatuan-penasihat-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_permohonan_kursus_persatuan_penasihat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_permohonan_kursus_persatuan_penasihat_id], [
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
            'pengurusan_permohonan_kursus_persatuan_penasihat_id',
            'pengurusan_permohonan_kursus_persatuan_id',
            'nama',
            'tarikh_mula_bertugas',
            'tarikh_tamat_bertugas',
            'silibus',
            'catatan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
