<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefKategoriELaporanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Kategori Elaporans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-elaporan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Kategori Elaporan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'desc',
            [
                'attribute' => 'show_public',
                'value' => function ($model) {
                    return $model->show_public == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],
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
