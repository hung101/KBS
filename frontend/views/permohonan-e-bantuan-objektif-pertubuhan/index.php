<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanObjektifPertubuhanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objektif Pertubuhan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-objektif-pertubuhan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Objektif Pertubuhan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'objektif_pertubuhan_id',
            //'permohonan_e_bantuan_id',
            [
                'attribute' => 'objektif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::objektif,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
