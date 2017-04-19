<?php
use app\models\general\GeneralLabel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefDokumenPengurusanInsuransSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::dokumen;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-pengurusan-insurans-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle.' '.GeneralLabel::dokumen, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'parent_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_tuntutan,
                ],
                'value' => 'refJenisTuntutan.desc',
            ],
            [
                'attribute' => 'desc',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::desc,
                ]
            ],
            //'aktif',
            [
                'attribute' => 'aktif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktif,
                ],
                'value' => function ($model) {
                    return $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],
            //'created_by',
            //'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
