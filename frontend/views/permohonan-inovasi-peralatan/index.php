<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanInovasiPeralatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Projek Inovasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-inovasi-peralatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Permohonan Projek Inovasi', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_inovasi_peralatan_id',
            //'tarikh_permohonan',
            [
                'attribute' => 'tarikh_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_permohonan,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_permohonan);
                },
            ],
            [
                'attribute' => 'pemohon',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pemohon,
                ]
            ],
            [
                'attribute' => 'nama_peralatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_peralatan,
                ]
            ],
            //'ringkasan_inovasi_peralatan',
            // 'pegawai_yang_bertanggungjawab',
            // 'catitan_ringkas',
            // 'status_permohonan',
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanProjekInovasi.desc'
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
