<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */

//$this->title = $model->bsp_pertukaran_program_pengajian_id;
$this->title = GeneralLabel::viewTitle . ' Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pertukaran_program_pengajian, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_pertukaran_program_pengajian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_pertukaran_program_pengajian_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPertukaranProgramPengajianSebab' => $searchModelBspPertukaranProgramPengajianSebab,
        'dataProviderBspPertukaranProgramPengajianSebab' => $dataProviderBspPertukaranProgramPengajianSebab,
        'searchModelBspPertukaranProgramPengajianDokumen' => $searchModelBspPertukaranProgramPengajianDokumen,
        'dataProviderBspPertukaranProgramPengajianDokumen' => $dataProviderBspPertukaranProgramPengajianDokumen,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
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
    ]);*/ ?>

</div>
