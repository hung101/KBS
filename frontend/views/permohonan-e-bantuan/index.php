<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_ebantuan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_ebantuan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

        <div class="CGridViewContainer">
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_e_bantuan_id',
            [
                'attribute' => 'ebantuan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ebantuan_id,
                ]
            ],
            [
                'attribute' => 'no_pendaftaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_pendaftaran,
                ]
            ],
            [
                'attribute' => 'nama_pertubuhan_persatuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pertubuhan_persatuan,
                ]
            ],
            //'tarikh_didaftarkan',
            /*[
                'attribute' => 'tarikh_didaftarkan',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_didaftarkan);
                },
            ],*/
            //'pejabat_yang_mendaftarkan',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'no_telefon_pejabat',
            // 'no_telefon_bimbit',
            // 'no_fax',
            // 'email:email',
            // 'bilangan_keahlian',
            // 'bilangan_cawangan_badan_gabungan',
            // 'objektif_pertubuhan',
            // 'aktiviti_dan_kejayaan_yang_dicapai',
            [
                'attribute' => 'nama_program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_program,
                ]
            ],
            //'jumlah_bantuan_yang_dipohon',
            [
                'attribute' => 'jumlah_bantuan_yang_dipohon',
                'contentOptions' => ['class' => 'gribview-column-number'],
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_bantuan_yang_dipohon,
                ],
                'label' => GeneralLabel::jumlah_bantuan_yang_dipohon,
                'format'=>['decimal',2]
            ],
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelulusan,
                ],
                'value' => 'refKelulusan.desc'
            ],
            [
                'attribute' => 'bil_mesyuarat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bil_mesyuarat,
                ]
            ],
            [
                'attribute' => 'tarikh_mesyuarat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mesyuarat,
                ]
            ],
            [
                'attribute' => 'jumlah_diluluskan',
                'contentOptions' => ['class' => 'gribview-column-number'],
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_diluluskan,
                ],
                'format'=>['decimal',2]
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
    

</div>
