<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsMinitMesyuaratJawatankuasaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::maklumat_mesyuarat_agung_tahunan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::maklumat_mesyuarat_agung_tahunan, ['create', 'profil_badan_sukan_id' => $profil_badan_sukan_id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'mesyuarat_id',
            //'tarikh',
            [
                'attribute' => 'tarikh',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);
                },
            ],
            //'masa',
            'tempat',
            [
                'attribute' => 'profil_badan_sukan_id',
                'value' => 'refBadanSukan.nama_badan_sukan'
            ],
            //'mengikut_perlembagaan',
            //'jumlah_ahli_yang_hadir',

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
