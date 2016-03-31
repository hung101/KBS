<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlSejarahPerubatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sejarah Perubatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-sejarah-perubatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Sejarah Perubatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_sejarah_perubatan_id',
            //'atlet_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'nama_perubatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_perubatan,
                ]
            ],
            //'butiran_perubatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
