<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspBorangBorangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bsp Borang Borangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-borang-borang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bsp Borang Borang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bsp_borang_borang_id',
            'bsp_pemohon_id',
            'bsp_03',
            'bsp_04',
            'bsp_05',
            // 'bsp_07',
            // 'bsp_08',
            // 'bsp_09',
            // 'bsp_12',
            // 'bsp_13',
            // 'bsp_14',
            // ,
            // ,
            // ,
            // ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
