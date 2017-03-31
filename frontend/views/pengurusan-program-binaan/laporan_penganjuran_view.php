<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaan */

$ref = \app\models\RefJenisPermohonan::findOne($model->jenis_permohonan);
$jenisPermohonan = $ref['desc'];

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_program_binaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan, 'url' => ['index']];
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
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['update'])): ?>
            <?= Html::a(GeneralLabel::print_jkb, ['print-jkk-jkp', 'id' => $model->pengurusan_program_binaan_id], ['class' => 'btn btn-info custom_button', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['update']) && $jenisPermohonan === 'USPTN'): ?>
            <?= Html::a(GeneralLabel::print_borang_permohonan, ['print-borang-permohonan', 'id' => $model->pengurusan_program_binaan_id], ['class' => 'btn btn-success custom_button', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['update']) && $jenisPermohonan === 'USPTN'): ?>
            <?= Html::a(GeneralLabel::laporan_penganjuran_penyertaan, ['laporan-penganjuran', 'id' => $model->pengurusan_program_binaan_id], ['class' => 'btn btn-warning custom_button', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
