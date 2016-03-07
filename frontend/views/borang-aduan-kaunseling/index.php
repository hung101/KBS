<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangAduanKaunselingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borang Aduan Atlet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kaunseling-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Borang Aduan Atlet', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_aduan_kaunseling_id',
            //'nama_pengadu',
            [
                'attribute' => 'nama_pengadu',
                'value' => 'atlet.name_penuh'
            ],
            'tarikh_aduan',
            'no_aduan',
            //'status_aduan',
            [
                'attribute' => 'status_aduan',
                'value' => 'refStatusAduan.desc'
            ],
            // 'aduan_kategori',
            // 'penyataan_aduan',
            // 'tindakan_yang_telah_diambil',
            // 'dokumen_berkaitan_yang_dilampirkan',
            // 'bantuan_yang_anda_perlukan',
            // 'rujukan_aduan_kepada_cawangan_yang_berkaitan',
            // 'rujuk_aduan_kepada_atlet',
            // 'tiada_sebarang_tindakan',
            // 'maklumbalas_kepada_pengadu',
            // 'tindakan_susulan',
            // 'aduan_dimajukan_kepada_agensi_lain',
            // 'catatan',

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
