<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukan */

//$this->title = $model->profil_badan_sukan;
$this->title = GeneralLabel::profil_badan_sukan;
$this->params['breadcrumbs'][] = (Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN) ? ['label' => GeneralLabel::profil_badan_sukan, 'url' => ['index']] : ['label' => GeneralLabel::pengurusan_maklumat_psk, 'url' => ['index-msn']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="profil-badan-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['update']) && (Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN)): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->profil_badan_sukan], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['delete']) && (Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN)): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->profil_badan_sukan], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::print_pdf, [ 'class' => 'btn btn-info', 'onclick' => 'window.print();' ]); ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profil_badan_sukan',
            'nama_badan_sukan',
            'nama_badan_sukan_sebelum_ini',
            'no_pendaftaran_sijil_pendaftaran',
            'tarikh_lulus_pendaftaran',
            'jenis_sukan',
            'alamat_tetap_badan_sukan',
            'alamat_surat_menyurat_badan_sukan',
            'no_telefon_pejabat',
            'no_faks_pejabat',
            'emel_badan_sukan',
            'pengiktirafan_yang_pernah_diterima_badan_sukan',
        ],
    ])*/ ?>

</div>
