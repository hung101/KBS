<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View Atlet::findOne($id)*/
/* @var $searchModel frontend\models\PlTemujanjiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::temujanji;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::pendaftaran_temujanji, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_temujanji_id',
            //'atlet_id',
            //'tarikh_temujanji',
            [
                'attribute' => 'tarikh_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_format,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_atlet,
                ],
                'value' => 'atlet.name_penuh'
            ],
            [
                'attribute' => 'atlet_ic',
                'label' => GeneralLabel::ic_no,
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ic_no,
                ],
                'value' => 'atlet.ic_no'
            ],
            [
                'attribute' => 'jenis_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'status_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_temujanji,
                ],
                'value' => 'refStatusTemujanjiPesakitLuar.desc'
            ],
            // 'pegawai_yang_bertanggungjawab',
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pegawai_yang_bertanggungjawab,
                ],
                'value' => 'refPegawaiPerubatan.desc'
            ],
            // 'catitan_ringkas',
            [
                'attribute' => 'catatan_tambahan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::catatan_tambahan,
                ]
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
