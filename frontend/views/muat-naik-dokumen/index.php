<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MuatNaikDokumenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Muat Naik Dokumen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muat-naik-dokumen-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Muat Naik Dokumen', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'muat_naik_dokumen_id',
            //'kategori_muat_naik',
            [
                'attribute' => 'kategori_muat_naik',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_muat_naik,
                ],
                'value' => 'refKategoriMuatnaik.desc'
            ],
            //'muat_naik_dokumen',
            [
                'attribute' => 'muat_naik_dokumen',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::muat_naik_dokumen,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->muat_naik_dokumen){
                        //return Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_dokumen , ['target'=>'_blank']);
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->muat_naik_dokumen .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            [
                'attribute' => 'tarikh_muat_naik',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_muat_naik,
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
