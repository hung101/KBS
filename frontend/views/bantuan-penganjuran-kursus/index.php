<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKursusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-index" style="overflow-x:scroll !important">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['update'])){
            //$template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_id',
            /*[
                'attribute' => 'badan_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::badan_sukan,
                ],
                'value' => 'refProfilBadanSukan.nama_badan_sukan'
            ],*/
            [
                'attribute' => 'nama_kursus_seminar_bengkel',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_kursus_seminar_bengkel,
                ],
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            /*[
                'attribute' => 'no_pendaftaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_pendaftaran,
                ],
            ],*/
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
            // 'nama_kursus_seminar_bengkel',
            // 'tarikh',
            // 'tempat',
            // 'tujuan',
            // 'bil_penceramah',
            // 'bil_peserta',
            // 'bil_urusetia',
            // 'anggaran_perbelanjaan',
            // 'kertas_kerja',
            // 'surat_rasmi_badan_sukan_ms_negeri',
            // 'butiran_perbelanjaan',
            // 'maklumat_lain_sokongan',
            //'jumlah_bantuan_yang_dipohon',
            [
				'label' => GeneralLabel::jumlah_bantuan_yang_dipohon_index,
                'attribute' => 'jumlah_bantuan_yang_dipohon',
				'headerOptions' => ['style' => 'width:100px'],
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_bantuan_yang_dipohon,
                ],
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusBantuanPenganjuranKursus.desc'
            ],
            // 'catatan',
            //'tarikh_permohonan',
            [
                'attribute' => 'tarikh_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_format,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'selesai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::selesai,
                ],
                'value' => 'refKelulusan.desc'
            ],
            // 'jumlah_dilulus',
            // 'jkb',
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
                        ['bantuan-penganjuran-kursus-pegawai-teknikal-laporan/load-bantuan-penganjuran', 'bantuan_penganjuran_kursus_id' =>$model->bantuan_penganjuran_kursus_id], 
                        [
                            'title' => GeneralLabel::laporan,
                            'target' => '_blank'
                        ]);
                        
                        return ($model->status_permohonan == app\models\RefStatusBantuanPenganjuranKursus::LULUS &&
        ((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['kelulusan']) && $model->laporan_hantar_flag == 1) ||
        !isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['kelulusan']))) ? $laporanLink : '';
                    },
                ],
                'template' => $template .= ' {report}',
            ],
        ],
    ]); ?>
</div>
