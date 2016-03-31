<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanJaringanAntarabangsaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_jaringan_antarabangsa;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jaringan-antarabangsa-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_jaringan_antarabangsa, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_jaringan_antarabangsa_id',
            [
                'attribute' => 'nama_badan_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_badan_sukan,
                ]
            ],
            //'negara',
            [
                'attribute' => 'negara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::negara,
                ],
                'value' => 'refNegara.desc'
            ],
            //'nama_pemohon',
            [
                'attribute' => 'nama_pemohon',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pemohon,
                ],
                'value' => 'refPemohonJaringanAntarabangsa.desc'
            ],
            //'no_kad_pengenalan',
            // 'jantina',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'pegawai_teknikal',
            // 'permohonan',
            // 'jenis_program',
            // 'no_telefon',
            // 'no_tel_bimbit',
            // 'no_faks',
            // 'emel',
            // 'nama_majikan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',
            // 'jawatan_di_persatuan',
            // 'tahap_kelayakan_sekarang',

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
