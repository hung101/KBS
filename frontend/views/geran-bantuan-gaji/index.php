<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GeranBantuanGajiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geran Bantuan Gaji';
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
            <?= Html::a(GeneralLabel::createTitle . ' Geran Bantuan Gaji', ['create'], ['class' => 'btn btn-success']) ?>
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
                'value' => 'refStatusPermohonanGeranBantuanGajiJurulatih.desc'
            ],
            // 'status_keaktifan_jurulatih',
            //'kategori_geran',
            [
                'attribute' => 'kategori_geran',
                'value' => 'refKategoriGeranJurulatih.desc'
            ],
            'jumlah_geran',
            // 'status_geran',
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
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
