<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use app\models\RefStatusBantuanPenganjuranKejohanan;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['update'])){
            //$template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['delete'])){
            //$template .= ' {delete}';
        }
        
        $template .= ' {report}';
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['create'])): ?>
        <p>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_id',
            //'badan_sukan',
            [
                'attribute' => 'badan_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::badan_sukan,
                ],
                'value' => 'refProfilBadanSukan.nama_badan_sukan'
            ],
            //'sukan',
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'no_pendaftaran',
            [
                'attribute' => 'no_pendaftaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_pendaftaran,
                ],
            ],
            //'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_telefon',
            // 'no_faks',
            // 'laman_sesawang',
            // 'facebook',
            // 'twitter',
            // 'nama_bank',
            // 'no_akaun',
            //'nama_kejohanan_pertandingan',
            [
                'attribute' => 'nama_kejohanan_pertandingan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_kejohanan_pertandingan,
                ],
            ],
            // 'peringkat',
            // 'tarikh_mula',
            // 'tarikh_tamat',
            // 'tempat',
            // 'tujuan',
            // 'bil_pasukan',
            // 'bil_peserta',
            // 'bil_pengadil_hakim',
            // 'bil_pegawai_teknikal',
            // 'bilangan_pembantu',
            // 'anggaran_perbelanjaan',
            // 'kertas_kerja',
            // 'surat_rasmi_badan_sukan_ms_negeri',
            // 'permohonan_rasmi_dari_ahli_gabungan',
            // 'maklumat_lain_sokongan',
            // 'jumlah_bantuan_yang_dipohon',
            //'status_permohonan',
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusBantuanPenganjuranKejohanan.desc'
            ],
            // 'catatan',
            // 'tarikh_permohonan',
            // 'jumlah_dilulus',
            // 'jkb',
            // 'tarikh_jkb',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                    'report' => function ($url, $model) {
                        $laporanLink =  Html::a('<span class="glyphicon glyphicon-list-alt"></span>', 
                        ['bantuan-penganjuran-kejohanan-laporan/load', 'bantuan_penganjuran_kejohanan_id' =>$model->bantuan_penganjuran_kejohanan_id], 
                        [
                            'title' => GeneralLabel::laporan,
                            'target' => '_blank'
                        ]);
                        
                        return $model->status_permohonan == RefStatusBantuanPenganjuranKejohanan::LULUS ? $laporanLink : '';
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
</div>
