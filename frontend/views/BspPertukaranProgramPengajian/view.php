<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */

$this->title = $model->bsp_pertukaran_program_pengajian_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Pertukaran Program Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_pertukaran_program_pengajian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_pertukaran_program_pengajian_id], [
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
            'bsp_pertukaran_program_pengajian_id',
            'bsp_pemohon_id',
            'tarikh',
            'bidang_pengajian_kursus',
            'fakulti',
            'tarikh_mula_pengajian',
            'tarikh_tamat_pengajian',
            'tempoh_perlanjutan_semester',
        ],
    ]) ?>

</div>
