<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaobsPenganjurSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penganjuran Acara Sukan Yang Disanksi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjur-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Penganjuran Acara Sukan Yang Disanksi', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penganjur_id',
            //'penganjuran_id',
            //'profil_syarikat',
            'nama_penganjur',
            //'no_pendaftaran_syarikat',
            //'tarikh_penubuhan_syarikat',
            // 'sijil_pendaftaran',
            // 'alamat_penganjur',
            // 'no_telefon_penganjur',
            // 'no_faks_penganjur',
            // 'emel_penganjur',
            // 'kertas_cadangan_pelaksanaan',
            'nama_aktiviti',
            //'jenis_sukan',
            [
                'attribute' => 'jenis_sukan',
                'value' => 'refSukan.desc'
            ],
            'tarikh_aktiviti',
            'alamat_lokasi',
            // 'pemilik_lokasi',
            // 'bilangan_peserta',
            // 'negara_peserta',
            // 'kos_aktiviti',
            // 'sumber_kewangan',
            // 'surat_sokongan',
            // 'laporan_penganjuran',

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
