<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ForumSeminarPersidanganDiLuarNegaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::bantuan_menghadiri_program_antarabangsa;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-persidangan-di-luar-negara-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_menghadiri_program_antarabangsa, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'forum_seminar_persidangan_di_luar_negara_id',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'amaun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::amaun,
                ]
            ],
            //'negara',
            [
                'attribute' => 'negara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::negara,
                ],
                'value' => 'refNegara.desc'
            ],
			[
                'attribute' => 'jumlah_diluluskan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_diluluskan,
                ]
            ],
            //'status_permohonan',
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanBantuanMenghadiriProgramAntarabangs.desc'
            ],
            // 'catatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return ((isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['update']) 
                                && $model->hantar_flag == 0) || 
                                isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['status_permohonan'])) ? 
                        Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]) : '';

                    },
                    'update' => function ($url, $model) {
                        $link =  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        ]);
                        
                        return ((isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['update']) 
                                && $model->hantar_flag == 0) || 
                                isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['status_permohonan'])) ? $link : '';
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
