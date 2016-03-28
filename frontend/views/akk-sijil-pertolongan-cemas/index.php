<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AkkSijilPertolonganCemasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akk Sijil Pertolongan Cemas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-sijil-pertolongan-cemas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akk Sijil Pertolongan Cemas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'akk_sijil_pertolongan_cemas_id',
            'akademi_akk_id',
            'no_sijil',
            'tahap',
            'tahun',
            // 'sijil',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
