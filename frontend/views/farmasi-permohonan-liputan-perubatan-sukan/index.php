<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FarmasiPermohonanLiputanPerubatanSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Liputan Perubatan Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-liputan-perubatan-sukan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Permohonan Liputan Perubatan Sukan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_liputan_perubatan_sukan_id',
            //'nama_program',
            'tarikh_program',
            'tempat_program',
            [
                'attribute' => 'kategori_program',
                'value' => 'refKategoriProgramLiputanPerubatanSukan.desc'
            ],
            'nama_pemohon',
            // 'no_tel_pemohon',
            // 'pegawai_bertugas',
            // 'muat_naik',
            //'kelulusan_ceo',
            [
                'attribute' => 'kelulusan_ceo',
                'value' => 'refKelulusanCEO.desc'
            ],
            //'kelulusan_pbu',
            [
                'attribute' => 'kelulusan_pbu',
                'value' => 'refKelulusanPBU.desc'
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
