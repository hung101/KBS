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
<div class="bantuan-penganjuran-kursus-index">
    
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
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_id',
            'badan_sukan',
            'sukan',
            'no_pendaftaran',
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
             'jumlah_bantuan_yang_dipohon',
             'status_permohonan',
            // 'catatan',
             'tarikh_permohonan',
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
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
</div>
