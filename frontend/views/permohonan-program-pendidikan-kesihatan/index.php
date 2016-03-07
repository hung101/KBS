<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanProgramPendidikanKesihatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Program Pendidikan Kesihatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-kesihatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['delete'])){
            $template .= ' {delete}';
        }
    ?>
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Permohonan Program Pendidikan Kesihatan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_program_pendidikan_kesihatan_id',
            'nama_program',
            'tarikh_program',
            'tempat_program',
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
