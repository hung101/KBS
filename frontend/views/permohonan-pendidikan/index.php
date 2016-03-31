<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_pendidikan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_pendidikan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_pendidikan_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            [
                'attribute' => 'no_ic',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_ic,
                ]
            ],
            //'umur',
            //'jantina',
            // 'tinggi',
            // 'berat',
            // 'alamat_rumah_1',
            // 'alamat_rumah_2',
            // 'alamat_rumah_3',
            // 'alamat_rumah_negeri',
            // 'alamat_rumah_bandar',
            // 'alamat_rumah_poskod',
            // 'no_telefon_rumah',
            // 'no_telefon_bimbit',
            // 'nama_ibu_bapa_penjaga',
            //'tahap_pendidikan',
            [
                'attribute' => 'tahap_pendidikan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahap_pendidikan,
                ],
                'value' => 'refTahapPendidikan.desc'
            ],
            // 'aliran',
            // 'keputusan_spm',
            // 'pilihan_aliran_spm',
            // 'sukan',
            // 'acara',
            // 'tahun_program',
            // 'muat_naik',
            // 'catatan',
            // 'alamat_pendidikan_1',
            // 'alamat_pendidikan_2',
            // 'alamat_pendidikan_3',
            // 'alamat_pendidikan_negeri',
            // 'alamat_pendidikan_bandar',
            // 'alamat_pendidikan_poskod',
            // 'no_tel_pendidikan',
            // 'no_fax_pendidikan',
            // 'kelulusan',
            // 'nama_pencadang',
            // 'jawatan_pencadang',
            // 'no_telefon_pencadang',
            // 'sekolah_unit_sukan_pdd_psk_pencadang',
            // 'nama_pengesahan',
            // 'jawatan_pengesahan',
            // 'no_telefon_pengesahan',
            // 'sekolah_unit_sukan_pdd_psk_pengesahan',

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
