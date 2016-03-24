<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenganjuranKursusPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penganjuran_kursus_senarai_peserta;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::penganjuran_kursus_senarai_peserta, Url::to(['create', 'penganjuran_kursus_id' => $penganjuran_kursus_id]), ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penganjuran_kursus_peserta_id',
            //'kategori_kursus',
            //'nama_kursus',
            //'kod_kursus',
            //'tarikh',
            // 'tempat',
            // 'yuran',
            'nama_penuh',
            // 'muatnaik_gambar',
            //'jantina',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            // 'taraf_perkahwinan',
            // 'no_passport',
            // 'no_kad_pengenalan',
            // 'no_kp_polis_tentera',
            // 'kaum',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_tel_bimbit',
            // 'no_tel_rumah',
            // 'emel',
            // 'pekerjaan',
            // 'nama_majikan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',
            // 'no_tel_majikan',
            // 'no_faks_majikan',
            // 'kelulusan_akademi',
            // 'nama_kelulusan',
            // 'kelulusan_sukan_spesifik',
            // 'nama_sukan_akademi',
            // 'kelulusan_sains_sukan',
            // 'sijil_spkk_msn',
            // 'lesen_kejurulatihan_msn',
            // 'status_jurulatih',
            // 'lantikan',
            // 'nama_sukan_jurulatih',
            // 'tahun_berkhidmat_mula',
            // 'tahun_berkhidmat_tamat',
            // 'pencapaian',
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
                'value' => 'refKelulusan.desc'
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

</div>
