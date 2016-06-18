<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InventoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::inventori;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['inventori']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['inventori']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['inventori']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::inventori, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'inventori_id',
            'tarikh',
            //'program',
            //'sukan',
            'no_co',
            // 'alamat_pembekal_1',
            // 'alamat_pembekal_2',
            // 'alamat_pembekal_3',
            // 'alamat_pembekal_negeri',
            // 'alamat_pembekal_bandar',
            // 'alamat_pembekal_poskod',
            // 'perkara:ntext',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
