<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefStatusTempahanKemudahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Status Tempahan Kemudahans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-tempahan-kemudahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Status Tempahan Kemudahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'desc',
            [
                'attribute' => 'report_flag',
                'value' => function ($model) {
                    return $model->report_flag == 1 ? GeneralLabel::yes : GeneralLabel::no;
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
