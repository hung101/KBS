<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_perkhidmatan_analisa_perlawanan_dan_biomekanik;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_perkhidmatan_analisa_perlawanan_dan_biomekanik, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            [
                'attribute' => 'jenis_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);
                },
            ],
            //'sukan',
            [
                'attribute' => 'tujuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tujuan,
                ]
            ],
            //'perkhidmatan',
            [
                'attribute' => 'perkhidmatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::perkhidmatan,
                ],
                'value' => 'refPerkhidmatanBiomekanik.desc'
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
