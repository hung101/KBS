<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan */

$this->title = $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penyertaan Pegawai Teknikal Dicadangkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-dicadangkan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'bantuan_penyertaan_pegawai_teknikal_dicadangkan_id',
            'bantuan_penyertaan_pegawai_teknikal_id',
            'badan_sukan',
            'sukan',
            'nama',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_kad_pengenalan',
            'umur',
            'no_passport',
            'jantina',
            'no_telefon',
            'alamat_e_mail',
            'tahap_akademik',
            'tahap_kelayakan_sukan_peringkat_kebangsaan',
            'tahap_kelayakan_sukan_peringkat_antarabangsa',
            'nama_majikan',
            'no_telefon_majikan',
            'no_faks',
            'jawatan',
            'gred',
            'nama_kejohanan_kursus',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
