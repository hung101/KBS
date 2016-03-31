<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangPenilaianKaunselingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::laporan_sesi_kaunseling;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-kaunseling-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::laporan_sesi_kaunseling, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_penilaian_kaunseling_id',
            //'profil_konsultan_id',
            [
                'attribute' => 'profil_konsultan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::profil_konsultan_id,
                ],
                'value' => 'refUser.full_name'
            ],
            [
                'attribute' => 'atlet',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            //'diagnosis',
           // 'preskripsi',
            //'cadangan',
            // 'rujukan',
            // 'tindakan_selanjutnya',
            // 'kategori_permasalahan',
            [
                'attribute' => 'kategori_permasalahan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_permasalahan,
                ],
                'value' => 'refKategoriMasalahKaunseling.desc'
            ],
            // 'tarikh_temujanji',

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
