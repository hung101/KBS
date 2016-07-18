<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikanKeputusanSpm */

$this->title = $model->permohonan_pendidikan_keputusan_spm_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan Keputusan Spms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-keputusan-spm-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->permohonan_pendidikan_keputusan_spm_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->permohonan_pendidikan_keputusan_spm_id], [
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
            'permohonan_pendidikan_keputusan_spm_id',
            'permohonan_pendidikan_id',
            'subjek',
            'keputusan',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
