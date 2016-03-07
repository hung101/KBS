<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaan */

//$this->title = $model->elaporan_pelaksaan_id;
$this->title = GeneralLabel::viewTitle . ' E-Laporan Pelaksanaan / Program / Aktiviti';
$this->params['breadcrumbs'][] = ['label' => 'E-Laporan Pelaksanaan / Program / Aktiviti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->elaporan_pelaksaan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->elaporan_pelaksaan_id], [
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
        'searchModelGambar' => $searchModelGambar,
        'dataProviderGambar' => $dataProviderGambar,
        'searchModelObjektif' => $searchModelObjektif,
        'dataProviderObjektif' => $dataProviderObjektif,
        'searchModelKerjasama' => $searchModelKerjasama,
        'dataProviderKerjasama' => $dataProviderKerjasama,
        'searchModelKekurangan' => $searchModelKekurangan,
        'dataProviderKekurangan' => $dataProviderKekurangan,
        'searchModelKelebihan' => $searchModelKelebihan,
        'dataProviderKelebihan' => $dataProviderKelebihan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'elaporan_pelaksaan_id',
            'kategori_elaporan',
            'nama_projek_program_aktiviti_kejohanan',
            'peringkat',
            'nama_penganjur_persatuan_kerjasama',
            'jumlah_bantuan_peruntukan',
            'jumlah_perbelanjaan',
            'no_cek_eft',
            'tarikh_cek_eft',
            'tarikh_pelaksanaan_mula',
            'tarikh_pelaksanaan_tarikh',
            'objektif_pelaksaan',
            'alamat_tempat_pelaksanaan_1',
            'dirasmikan_oleh',
            'lelaki',
            'perempuan',
            'l_melayu',
            'l_cina',
            'l_india',
            'l_lain_lain',
            'jumlah_penyertaan',
            'rumusan_program',
            'muat_naik',
        ],
    ])*/ ?>

</div>
