<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use common\models\PublicUser;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaan */

//$this->title = $model->elaporan_pelaksaan_id;
$this->title = GeneralLabel::viewTitle . ' E-Laporan Pelaksanaan / Program / Aktiviti';
//$this->params['breadcrumbs'][] = ['label' => 'E-Laporan Pelaksanaan / Program / Aktiviti', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->elaporan_pelaksaan_id], ['class' => 'btn btn-primary']) ?>
        <?php 
            if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_BANTUAN){
                echo Html::a('Kembali', ['site/e-bantuan-home'], ['class' => 'btn btn-warning']);
            } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_LAPORAN){
                echo Html::a('Kembali', ['site/e-laporan-home'], ['class' => 'btn btn-warning']);
            }
        ?>
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
