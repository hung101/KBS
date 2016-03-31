<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletPenajaansokonganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atlet Penajaansokongans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-penajaansokongan-index">
    
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
            <?= Html::a('Create Atlet Penajaansokongan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'penajaan_sokongan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penajaan_sokongan_id,
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
                'attribute' => 'nama_syarikat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_syarikat,
                ]
            ],
            [
                'attribute' => 'alamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat,
                ]
            ],
            [
                'attribute' => 'emel',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::emel,
                ]
            ],
            // 'no_telefon',
            // 'peribadi_yang_bertanggungjawab',
            // 'jenis_kontrak',
            // 'nilai_kontrak',
            // 'tahun_permulaan',
            // 'tahun_akhir',
            // 'barang_yang_penyokong',

            ['class' => 'yii\grid\ActionColumn',
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
