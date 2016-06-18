<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaklumatPegawaiTeknikalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::maklumat_pegawai_teknikal;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-pegawai-teknikal-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['maklumat-pegawai-teknikal']['update']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['maklumat-pegawai-teknikal']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['maklumat-pegawai-teknikal']['delete']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['maklumat-pegawai-teknikal']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['maklumat-pegawai-teknikal']['create']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['maklumat-pegawai-teknikal']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::maklumat_pegawai_teknikal, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id',
            //'bantuan_penganjuran_kursus_pegawai_teknikal_id',
            'badan_sukan',
            'sukan',
            'nama',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            'no_kad_pengenalan',
            // 'umur',
            // 'no_passport',
            // 'jantina',
            // 'no_telefon',
            // 'alamat_e_mail',
            // 'tahap_akademik',
            // 'tahap_kelayakan_sukan_peringkat_kebangsaan',
            // 'tahap_kelayakan_sukan_peringkat_antarabangsa',
            // 'nama_majikan',
            // 'no_telefon_majikan',
            // 'no_faks',
            // 'jawatan',
            // 'gred',
            // 'nama_kejohanan_kursus',
            // 'tarikh_mula',
            // 'tarikh_tamat',
            // 'tempat',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

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
