<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletPerubatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atlet Perubatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])): ?>
        <p>
            <?= Html::a('Create Atlet Perubatan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'perubatan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::perubatan_id,
                ]
            ],
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ]
            ],
            [
                'attribute' => 'kumpulan_darah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kumpulan_darah,
                ]
            ],
            [
                'attribute' => 'alergi_makanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alergi_makanan,
                ]
            ],
            [
                'attribute' => 'alergi_perubatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alergi_perubatan,
                ]
            ],
            // 'alergi_jenis_lain',
            // 'penyakit_semula_jadi',

            ['class' => 'yii\grid\ActionColumn',
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
