<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanInsuranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_insurans;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insuran-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle .' ' . GeneralLabel::pengurusan_insurans, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_insuran_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ],
                'value' => 'atlet.name_penuh'
            ],
            [
                'attribute' => 'nama_insuran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_insuran,
                ]
            ],
            [
                'attribute' => 'jumlah_tuntutan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_tuntutan,
                ]
            ],
            [
                'attribute' => 'tarikh_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_format,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value'=>'refStatusPermohonanInsuran.desc'
            ],
            /*[
                'attribute' => 'tarikh_tuntutan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tuntutan,
                ]
            ],*/
            // 'pegawai_yang_bertanggungjawab',

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
