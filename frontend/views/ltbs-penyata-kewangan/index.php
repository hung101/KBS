<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsPenyataKewanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyata Kewangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-penyata-kewangan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Penyata Kewangan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyata_kewangan_id',
            //'penyata_penerimaan_dan_pembayaran',
            [
                'attribute' => 'penyata_penerimaan_dan_pembayaran',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->penyata_penerimaan_dan_pembayaran){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->penyata_penerimaan_dan_pembayaran .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'penyata_pendapatan_dan_perbelanjaan',
            [
                'attribute' => 'penyata_pendapatan_dan_perbelanjaan',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->penyata_pendapatan_dan_perbelanjaan){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->penyata_pendapatan_dan_perbelanjaan .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'kunci_kira_kira',
            [
                'attribute' => 'kunci_kira_kira',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->kunci_kira_kira){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->kunci_kira_kira .'");'
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
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
