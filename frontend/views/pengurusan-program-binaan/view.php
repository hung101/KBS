<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaan */

//$this->title = $model->pengurusan_program_binaan_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Program Binaan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_program_binaan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_program_binaan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
        'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
        'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
        'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_program_binaan_id',
            'nama_ppn',
            'pengurus_pn',
            'kategori_permohonan',
            'jenis_permohonan',
            'sukan',
            'tempat',
            'tahap',
            'negeri',
            'daerah',
            'tarikh_mula',
            'tarikh_tamat',
            'sokongan_pn',
            'kelulusan',
        ],
    ])*/ ?>

</div>
