<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

use app\models\RefStatusTemujanjiFisioterapi;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlTemujanjiFisioterapiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::temujanji_fisioterapi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-fisioterapi-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji_fisioterapi, ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(GeneralLabel::jadual_pegawai, ['laporan-jadual-pegawai-temujanji'], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
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
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_temujanji,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'kategori_rawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_rawatan,
                ],
                'value' => 'refKategoriRawatan.desc'
            ],
            /*[
                'attribute' => 'nama_pesakit_luar',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pesakit_luar,
                ],
            ],*/
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_atlet,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            /*[
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ],
            ],  */         
            //'doktor_pegawai_perubatan',
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'nama_fisioterapi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_fisioterapi,
                ],
                'value' => 'refNamaFisioterapi.desc'
            ],
            [
                'attribute' => 'status_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_temujanji,
                ],
                'value' => 'refStatusTemujanjiPesakitLuar.desc',
                'filter' => Html::activeDropDownList($searchModel, 'status_temujanji', ArrayHelper::map(RefStatusTemujanjiFisioterapi::find()->asArray()->all(), 'id', 'desc'),['class'=>'form-control','prompt' => 'Select Category']),
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
