<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianDokumen */

//$this->title = $model->bsp_pertukaran_program_pengajian_dokumen_id;
$this->title = GeneralLabel::viewTitle . ' Dokumen Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Pertukaran Program Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-dokumen-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_pertukaran_program_pengajian_dokumen_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_pertukaran_program_pengajian_dokumen_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'bsp_pertukaran_program_pengajian_dokumen_id',
            'bsp_pertukaran_program_pengajian_id',
            'nama_dokumen',
            'upload',
        ],
    ]);*/ ?>

</div>
