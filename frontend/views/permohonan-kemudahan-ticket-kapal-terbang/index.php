<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanKemudahanTicketKapalTerbangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_kemudahan_ticket_kapal_terbang_id',
            [
                'attribute' => 'nama_pemohon',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pemohon,
                ]
            ],
            //'bahagian',
            //'jawatan',
            /*[
                'attribute' => 'destinasi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::destinasi,
                ]
            ],
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],*/
            [
                'attribute' => 'bahagian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bahagian,
                ],
                'value' => 'refBahagianKemudahan.desc'
            ],
            [
                'attribute' => 'cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cawangan,
                ],
                'value' => 'refCawanganKemudahan.desc'
            ],
            //'nama_program',
            [
                'attribute' => 'nama_program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_program,
                ],
                'value' => 'program.nama_program'
            ],
            // 'no_fail_kelulusan',
             [
                'attribute' => 'bil_penumpang',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bil_penumpang,
                ]
            ],
            // 'aktiviti',
            // 'kod_perbelanjaan',
            // 'sukan',
            // 'atlet',
            // 'jurulatih',
            // 'pegawai_teknikal',
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
                    'update' => function ($url, $model) {
                        $link =  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        ]);
                        
                        return ((isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['update']) 
                                && $model->hantar_flag == 0) || 
                                isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['kelulusan'])) ? $link : '';
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
