<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

//$this->title = $model->bsp_tamat_pengesahan_pengajian_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengesahan_tamat_pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengesahan_tamat_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_tamat_pengesahan_pengajian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_tamat_pengesahan_pengajian_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'bsp_tamat_pengesahan_pengajian_id',
            'nama_ipts',
            'pengajian',
            'bidang',
            'cgpa_pngk',
            'tarikh_tamat',
        ],
    ]);*/ ?>

</div>
