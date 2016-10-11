<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenilaianPrestasiAtletLatihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::jadual_latihan_periodisasi_jurulatih;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-latihan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::jadual_latihan_periodisasi_jurulatih, 
                    ['create', 'penilaian_prestasi_atlet_sasaran_id' =>$penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$atlet_id, 'penilaian_pestasi_id' =>$penilaian_pestasi_id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tbl_penilaian_prestasi_atlet_latihan_id',
            //'penilaian_pestasi_id',
            'tarikh_mula',
            'tarikh_tamat',
            'tempoh',
            'tempat',
            // 'keterangan:ntext',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 
                        ['delete', 'id' => $model->tbl_penilaian_prestasi_atlet_latihan_id, 'penilaian_prestasi_atlet_sasaran_id' =>$model->penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$model->atlet_id, 'penilaian_pestasi_id' =>$model->penilaian_pestasi_id], 
                        [
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
