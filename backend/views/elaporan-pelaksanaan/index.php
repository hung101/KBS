<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::sejarah;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        $template .= ' {update}';
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::borang_baru, ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksaan_id',
            //'kategori_elaporan',
            [
                'attribute' => 'kategori_elaporan',
                'value' => 'refKategoriELaporan.desc'
            ],
            'nama_projek_program_aktiviti_kejohanan',
            //'peringkat',
            [
                'attribute' => 'peringkat',
                'value' => 'refPeringkatELaporan.desc'
            ],
            [
                'attribute' => 'alamat_tempat_pelaksanaan_parlimen',
                'value' => 'refParlimen.desc'
            ],
            //'nama_penganjur_persatuan_kerjasama',
            // 'jumlah_bantuan_peruntukan',
            // 'jumlah_perbelanjaan',
            // 'no_cek_eft',
            // 'tarikh_cek_eft',
            //'tarikh_pelaksanaan_mula',
            [
                'attribute' => 'tarikh_pelaksanaan_mula',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_pelaksanaan_mula);
                },
            ],
            //'tarikh_pelaksanaan_akhir',
            [
                'attribute' => 'tarikh_pelaksanaan_akhir',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_pelaksanaan_akhir);
                },
            ],
            // 'objektif_pelaksaan',
            // 'tempat_pelaksanaan',
            // 'dirasmikan_oleh',
            // 'lelaki',
            // 'perempuan',
            // 'l_melayu',
            // 'l_cina',
            // 'l_india',
            // 'l_lain_lain',
            'jumlah_penyertaan',
            // 'rumusan_program',
            // 'muat_naik',

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
    
    <!--<?= Html::a('Kembali', ['site/e-laporan-home'], ['class' => 'btn btn-warning']) ?>-->

</div>
