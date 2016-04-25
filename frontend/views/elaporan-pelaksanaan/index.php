<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::elaporan_pelaksanaan_program_aktiviti;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::elaporan_pelaksanaan_program_aktiviti, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksaan_id',
            //'kategori_elaporan',
            [
                'attribute' => 'kategori_elaporan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_elaporan,
                ],
                'value' => 'refKategoriELaporan.desc'
            ],
            [
                'attribute' => 'nama_projek_program_aktiviti_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_projek_program_aktiviti_kejohanan,
                ]
            ],
            //'peringkat',
            [
                'attribute' => 'peringkat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::peringkat,
                ],
                'value' => 'refPeringkatELaporan.desc'
            ],
            [
                'attribute' => 'alamat_tempat_pelaksanaan_parlimen',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat_tempat_pelaksanaan_parlimen,
                ],
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
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_pelaksanaan_mula,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_pelaksanaan_mula);
                },
            ],
            //'tarikh_pelaksanaan_akhir',
            [
                'attribute' => 'tarikh_pelaksanaan_akhir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_pelaksanaan_akhir,
                ],
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
            [
                'attribute' => 'jumlah_penyertaan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_penyertaan,
                ]
            ],
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

</div>
