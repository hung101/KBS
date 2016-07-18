<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikanKursusPengajian */

$this->title = $model->permohonan_pendidikan_kursus_pengajian_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan Kursus Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-kursus-pengajian-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->permohonan_pendidikan_kursus_pengajian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->permohonan_pendidikan_kursus_pengajian_id], [
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
            'permohonan_pendidikan_kursus_pengajian_id',
            'permohonan_pendidikan_id',
            'kursus_pengajian',
            'universiti',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
