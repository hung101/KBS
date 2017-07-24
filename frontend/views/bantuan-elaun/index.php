<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanElaunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['create'])): ?>
        <p>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_elaun_id',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            //'muatnaik_gambar',
            /*[
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ]
            ],
            [
                'attribute' => 'tarikh_lahir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_lahir,
                ]
            ],*/
            [
                'attribute' => 'jenis_bantuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_bantuan,
                ],
                'value' => 'refJenisBantuanSue.desc'
            ],
            [
                'attribute' => 'nama_persatuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_persatuan,
                ],
                'value' => 'refProfilBadanSukan.nama_badan_sukan'
            ],
            [
                'attribute' => 'jumlah_elaun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_elaun,
                ],
            ],
			[
                'attribute' => 'jumlah_kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_kelulusan,
                ],
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanSue.desc'
            ],
            // 'umur',
            // 'jantina',
            // 'kewarganegara',
            // 'bangsa',
            // 'agama',
            // 'kelayakan_akademi',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_tel_bimbit',
            // 'emel',
            // 'kontrak',
            // 'jumlah_elaun',
            // 'muatnaik_dokumen',
            // 'status_permohonan',
            // 'catatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return ((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['update']) 
                                && $model->hantar_flag == 0) || 
                                isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['status_permohonan'])) ? 
                        Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]) : '';

                    },
                    'update' => function ($url, $model) {
                        $link =  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        ]);
                        
                        return ((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['update']) 
                                && $model->hantar_flag == 0) || 
                                isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['status_permohonan'])) ? $link : '';
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
