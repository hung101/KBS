<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlTemujanjiRehabilitasiAtlet::findOne($id)Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::temujanji_rehabilitasi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-rehabilitasi-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji_rehabilitasi, ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'nama_pesakit_luar',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pesakit_luar,
                ],
            ],
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ],
            ],  
            //'doktor_pegawai_perubatan',
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'nama_rehabilitasi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_rehabilitasi,
                ],
                'value' => 'refNamaFisioterapi.desc'
            ],
            [
                'attribute' => 'status_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_temujanji,
                ],
                'value' => 'refStatusTemujanjiPesakitLuar.desc'
            ],
            // 'pegawai_yang_bertanggungjawab',
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
