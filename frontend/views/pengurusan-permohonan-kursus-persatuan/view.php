<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use app\models\RefStatusPermohonanJkk;
use app\models\BorangProfilPesertaKpsk;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuan */

//$this->title = $model->pengurusan_permohonan_kursus_persatuan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-kursus-persatuan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['delete']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if($model->kelulusan_id == RefStatusPermohonanJkk::LULUS): ?>
            <?= Html::a('Surat Tawaran', ['surat-tawaran', 'pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?php 
            $modelBorang = BorangProfilPesertaKpsk::findOne(['pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id]);
            if(($modelBorang !== null && $modelBorang->hantar_flag == 1 && !Yii::$app->user->identity->profil_badan_sukan) || 
                Yii::$app->user->identity->profil_badan_sukan): 
        ?>
            <?= Html::a(GeneralLabel::borang_profil_peserta, ['/borang-profil-peserta-kpsk/load', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPermohonanKursusPersatuanPenasihat' => $searchModelPengurusanPermohonanKursusPersatuanPenasihat,
        'dataProviderPengurusanPermohonanKursusPersatuanPenasihat' => $dataProviderPengurusanPermohonanKursusPersatuanPenasihat,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_permohonan_kursus_persatuan_id',
            'nama',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'jantina',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'emel',
            'facebook',
            'kelayakan_akademi',
            'perkerjaan',
            'nama_majikan',
            'yuran_program',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
