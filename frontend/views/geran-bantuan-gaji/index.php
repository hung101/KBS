<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GeranBantuanGajiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::geran_bantuan_gaji;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geran-bantuan-gaji-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::geran_bantuan_gaji, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'geran_bantuan_gaji_id',
           // 'muatnaik_gambar',
            //'nama_jurulatih',
            [
                'attribute' => 'nama_jurulatih',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jurulatih,
                ],
                'value' => 'refJurulatih.nama'
            ],
            //'cawangan',
            //'sub_cawangan',
            // 'program_msn',
            // 'lain_lain_program',
            // 'pusat_latihan',
            // 'nama_sukan',
            // 'nama_acara',
            // 'status_jurulatih',
            //'status_permohonan',
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanGeranBantuanGajiJurulatih.desc'
            ],
            // 'status_keaktifan_jurulatih',
            //'kategori_geran',
            [
                'attribute' => 'kategori_geran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_geran,
                ],
                'value' => 'refKategoriGeranJurulatih.desc'
            ],
            [
                'attribute' => 'jumlah_geran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_geran,
                ]
            ],
            // 'status_geran',
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelulusan,
                ],
                'value' => 'refKelulusan.desc'
            ],
            // 'catatan',

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
