<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBiasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan E-Biasiswa';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-index">
    
    <?php
        $template = '{view}';
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_e_biasiswa_id',
            //'muat_naik_gambar',
            'nama',
            'no_kad_pengenalan',
            //'jantina',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            // 'keturunan',
            // 'agama',
            // 'taraf_perkahwinan',
            // 'kawasan_temuduga_anda',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_tel_bimbit',
            // 'no_pendaftaran_oku',
            // 'kategori_oku',
            // 'oku_lain_lain',
            // 'universiti_institusi',
            // 'program_pengajian',
            // 'kursus_bidang_pengajian',
            // 'falkulti',
            // 'kategori',
            // 'tarikh_tamat',
            // 'semester_terkini',
            // 'baki_semester_yang_tinggal',
            // 'no_matriks',
            // 'mendapat_pembiayaan_pendidikan',
            // 'sukan',
            // 'perakuan_pemohon',
            // 'kelulusan',
            //'status_permohonan',
            [
                'attribute' => 'status_permohonan',
                'value' => 'refStatusPermohonanEBiasiswa.desc'
            ],

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
    
    <p>
        <?= Html::a('Kembali', ['site/e-biasiswa-home'], ['class' => 'btn btn-warning']) ?>
    </p>

</div>
