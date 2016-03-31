<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GajiDanElaunJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gaji Dan Elaun Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-dan-elaun-jurulatih-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Gaji Dan Elaun Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'gaji_dan_elaun_jurulatih_id',
            //'nama_jurulatih',
            [
                'attribute' => 'nama_jurulatih',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jurulatih,
                ],
                'value' => 'refJurulatih.nama'
            ],
            //'no_kad_pengenalan',
            //'no_passport',
            //'nama_sukan',
            // 'tempoh_bayaran',
            //'bank',
            [
                'attribute' => 'bank',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bank,
                ],
                'value' => 'refBank.desc'
            ],
            // 'no_akaun',
            // 'cawangan',
            // 'catatan',

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
