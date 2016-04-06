<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsKejohananProgramAktivitiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::laporan_aktiviti_badan_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-kejohanan-program-aktiviti-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Laporan Aktiviti Badan Sukan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kejohanan_program_aktiviti_id',
            [
                'attribute' => 'nama_kejohanana_program_aktiviti_yang_disertai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_kejohanana_program_aktiviti_yang_disertai,
                ]
            ],
            //'tarikh_kejohanan_program_aktiviti_yang_disertai',
            [
                'attribute' => 'tarikh_kejohanan_program_aktiviti_yang_disertai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_kejohanan_program_aktiviti_yang_disertai,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_kejohanan_program_aktiviti_yang_disertai);
                },
            ],
            //'bilangan_peserta_yang_menyertai',
            //'kos_kejohanan_program_aktiviti_yang_disertai',

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
