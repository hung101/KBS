<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanBimbinganKaunselingPegawaiAnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_bimbingan_kaunseling_pegawai_anggota;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-bimbingan-kaunseling-pegawai-anggota-index">
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['create'])): ?>
    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_bimbingan_kaunseling_pegawai_anggota, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_bimbingan_kaunseling_pegawai_anggota_id',
            //'nama',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ],
            ],
            [
                'attribute' => 'nama_pegawai_anggota',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pegawai,
                ],
            ],
            //'jawatan',
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ],
            ],
            //'no_kad_pengenalan',
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ],
            ],
            //'umur',
            [
                'attribute' => 'umur',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::umur,
                ],
            ],
            // 'no_telefon',
            // 'emel',
            // 'bahagian',
            // 'taraf_perkahwinan',
            // 'status_jawatan',
            // 'jantina',
            // 'tarikh_temujanji',
            // 'kategori_masalah',
            // 'catatan_kaunselor',
            // 'tindakan_kaunselor',
            // 'cadangan_kaunselor',
            // 'tarikh_permohonan',
            // 'status_permohonan',
            // 'catatan_permohonan',
            // 'nama_pegawai_anggota',
            // 'no_kad_pengenalan_pegawai',
            // 'umur_pegawai',
            // 'jawatan_pegawai',
            // 'bahagian_pegawai',
            // 'no_tel_pegawai',
            // 'emel_pegawai',
            // 'taraf_perkahwinan_pegawai',
            // 'status_jawatan_pegawai',
            // 'jantina_pegawai',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $link =  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);
                        
                        return (isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['kelulusan'])) ? $link : '';

                    },
                    'update' => function ($url, $model) {
                        $link =  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        ]);
                        
                        return (isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['kelulusan'])) ? $link : '';
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
</div>
