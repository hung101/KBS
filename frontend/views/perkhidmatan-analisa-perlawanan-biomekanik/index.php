<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PerkhidmatanAnalisaPerlawananBiomekanikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perkhidmatan Analisa Perlawanan/Biomekanik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-analisa-perlawanan-biomekanik-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Perkhidmatan Analisa Perlawanan/Biomekanik', ['create', 'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => ''], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'perkhidmatan_analisa_perlawanan_biomekanik_id',
            //'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id',
            //'perkhidmatan',
            [
                'attribute' => 'perkhidmatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::perkhidmatan,
                ],
                'value' => 'refPerkhidmatanBiomekanik.desc'
            ],
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pegawai_yang_bertanggungjawab,
                ]
            ],
            // 'status_ujian',
            // 'catitan_ringkas',

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
