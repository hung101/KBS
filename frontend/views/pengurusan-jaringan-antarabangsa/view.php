<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJaringanAntarabangsa */

//$this->title = $model->pengurusan_jaringan_antarabangsa_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jaringan Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jaringan-antarabangsa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_jaringan_antarabangsa_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_jaringan_antarabangsa_id], [
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
        'searchModelKelayakan' => $searchModelKelayakan,
        'dataProviderKelayakan' => $dataProviderKelayakan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_jaringan_antarabangsa_id',
            'nama_badan_sukan',
            'negara',
            'nama_pemohon',
            'no_kad_pengenalan',
            'jantina',
            'alamat_surat_menyurat_1',
            'alamat_surat_menyurat_2',
            'alamat_surat_menyurat_3',
            'alamat_surat_menyurat_negeri',
            'alamat_surat_menyurat_bandar',
            'alamat_surat_menyurat_poskod',
            'pegawai_teknikal',
            'permohonan',
            'jenis_program',
            'no_telefon',
            'no_tel_bimbit',
            'no_faks',
            'emel',
            'nama_majikan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
            'jawatan_di_persatuan',
            'tahap_kelayakan_sekarang',
        ],
    ]);*/ ?>

</div>
