<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_id',
             'nama',
           // 'gambar',
            //'cawangan',
            [
                'attribute' => 'cawangan',
                'value' => 'refCawangan.desc'
            ],
            //'sub_cawangan_pelapis',
            [
                'attribute' => 'sub_cawangan_pelapis',
                'value' => 'refSubProgramPelapisJurulatih.desc'
            ],
           // 'lain_lain_program',
            // 'pusat_latihan',
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'value' => 'refSukan.desc'
            ],
            //'nama_acara',
            [
                'attribute' => 'nama_acara',
                'value' => 'refAcara.desc'
            ],
            // 'status_jurulatih',
            // 'status_permohonan',
            // 'status_keaktifan_jurulatih',
            
            // 'bangsa',
            // 'agama',
            // 'jantina',
            // 'warganegara',
            // 'tarikh_lahir',
            // 'tempat_lahir',
            // 'taraf_perkahwinan',
            // 'bil_tanggungan',
            // 'ic_no',
            // 'ic_no_lama',
            // 'ic_tentera',
            // 'passport_no',
            // 'tamat_tempoh',
            // 'no_visa',
            // 'tamat_visa_tempoh',
            // 'no_permit_kerja',
            // 'tamat_permit_tempoh',
            // 'alamat_rumah_1',
            // 'alamat_rumah_2',
            // 'alamat_rumah_3',
            // 'alamat_rumah_negeri',
            // 'alamat_rumah_bandar',
            // 'alamat_rumah_poskod',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'no_telefon',
            // 'emel',
            // 'status',
            // 'sektor',
            // 'jawatan',
            // 'no_telefon_pejabat',
            // 'nama_majikan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',

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
