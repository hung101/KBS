<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PembayaranInsentifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pembayaran_insentif;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['create'])): ?>
        <p>
            <?= Html::a( GeneralLabel::createTitle . ' ' . GeneralLabel::pembayaran_insentif, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pembayaran_insentif_id',
            //'kejohanan',
            [
                'attribute' => 'kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kejohanan,
                ],
            ],
            //'jenis_insentif',
            [
                'attribute' => 'jenis_insentif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_insentif,
                ],
                'value' => 'refJenisInsentif.desc'
            ],
            //'pingat',
            [
                'attribute' => 'pingat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pingat,
                ],
                'value' => 'refPingatInsentif.desc'
            ],
            //'kumpulan_temasya_kejohanan',
            [
                'attribute' => 'kumpulan_temasya_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kumpulan_temasya_kejohanan,
                ],
                'value' => 'refPengurusanInsentifTetapanShakamShakar.kumpulan_temasya_kejohanan'
            ],
            // 'rekod_baharu',
            //'jumlah',
            [
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ],
            ],
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelulusan,
                ],
                'value' => 'refKelulusan.desc'
            ],
            // 'tarikh_kelulusan',
            // 'tarikh_pembayaran_insentif',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
