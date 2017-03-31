<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AnugerahAhliJawantankuasaPengelolaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::anugerah_ahli_jawantankuasa_pengelola;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pengelola-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pengelola, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'tahun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun,
                ],
            ],
            //'anugerah_ahli_jawantankuasa_pengelola_id',
            //'ajk',
/*             [
                'attribute' => 'ajk',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' AJK',
                ],
                'value' => 'refAjk.desc'
            ],
            //'nama',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ],
            ],
            //'bahagian',
            [
                'attribute' => 'bahagian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bahagian,
                ],
                'value' => 'refBahagianAjk.desc'
            ], */
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
