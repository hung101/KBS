<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AnugerahPencalonanAtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::anugerah_pencalonan_atlet;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-atlet-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_pencalonan_atlet, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'anugerah_pencalonan_atlet',
            [
                'attribute' => 'nama_atlet',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_atlet,
                ]
            ],
            [
                'attribute' => 'tahun_pencalonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_pencalonan,
                ]
            ],
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'nama_acara',
            [
                'attribute' => 'nama_acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_acara,
                ],
                'value' => 'refAcara.desc'
            ],
            // 'status_pencalonan',
            // 'kejayaan',
            // 'ulasan_kejayaan',
            // 'susan_ranking_kebangsaan',
            // 'susan_ranking_asia',
            // 'susan_ranking_asia_tenggara',
            // 'susan_ranking_dunia',
            // 'sifat_kepimpinan_ketua_pasukan',
            // 'sifat_kepimpinan_jurulatih',
            // 'sifat_kepimpinan_asia_tenggara',
            // 'sifat_kepimpinan_penolong_jurulatih',
            // 'sifat_kepimpinan_pegawai_teknikal',
            // 'nama_sukan_sebelum_dicalon',
            // 'mewakili',
            // 'pencalonan_olahragawan_tahun',
            // 'pencalonan_olahragawati_tahun',
            // 'pencalonan_pasukan_lelaki_kebangsaan_tahun',
            // 'pencalonan_pasukan_wanita_kebangsaan_tahun',
            // 'pencalonan_olahragawan_harapan_tahun',
            // 'pencalonan_olahragawati_harapan_tahun',
            // 'memenangi_kategori_dalam_anugerah_sukan',
            // 'nama_kategori',
            // 'tahun',
            // 'kelulusan',

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
