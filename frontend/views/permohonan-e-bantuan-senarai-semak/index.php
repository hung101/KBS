<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanSenaraiSemakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Semak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-semak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Senarai Semak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_semak_id',
            //'permohonan_e_bantuan_id',
            //'kertas_kerja_projek_program',
            [
                'attribute' => 'kertas_kerja_projek_program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kertas_kerja_projek_program,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->kertas_kerja_projek_program){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja_projek_program .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'salinan_sijil_pendaftaran_persatuan_pertubuhan',
            [
                'attribute' => 'salinan_sijil_pendaftaran_persatuan_pertubuhan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::salinan_sijil_pendaftaran_persatuan_pertubuhan,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->salinan_sijil_pendaftaran_persatuan_pertubuhan){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->salinan_sijil_pendaftaran_persatuan_pertubuhan .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'salinan_perlembagaan_persatuan_pertubuhan',
            [
                'attribute' => 'salinan_perlembagaan_persatuan_pertubuhan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::salinan_perlembagaan_persatuan_pertubuhan,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->salinan_perlembagaan_persatuan_pertubuhan){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->salinan_perlembagaan_persatuan_pertubuhan .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'salinan_buku_bank',
            [
                'attribute' => 'salinan_buku_bank',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::salinan_buku_bank,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->salinan_buku_bank){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->salinan_buku_bank .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
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
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
