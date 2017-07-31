<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPusatLatihan */

//$this->title = $model->profil_pusat_latihan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_pusat_latihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_pusat_latihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->profil_pusat_latihan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->profil_pusat_latihan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['update'])): ?>
            <?= Html::a(GeneralLabel::permohonan_peralatan, ['/permohonan-peralatan/create'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
        'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
        'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
        'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
        'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
        'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profil_pusat_latihan_id',
            'nama_pusat_latihan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'no_faks',
            'emel',
            'tarikh_program_bermula',
            'tahun_siap_pembinaan',
            'kos_project',
            'keluasan_venue',
            'hakmilik',
            'kadar_sewaan',
            'status',
            'catatan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
