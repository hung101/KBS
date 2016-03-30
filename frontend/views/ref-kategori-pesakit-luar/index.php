<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefKategoriPesakitLuarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Kategori Pesakit Luars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pesakit-luar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Kategori Pesakit Luar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desc',
            //'aktif',
            [
                'attribute' => 'aktif',
                'value' => function ($model) {
                    return $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>