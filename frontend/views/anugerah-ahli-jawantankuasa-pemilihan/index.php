<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AnugerahAhliJawantankuasaPemilihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan, ['create'], ['class' => 'btn btn-success']) ?>
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
            //'anugerah_ahli_jawantankuasa_pemilihan_id',
            //'perwakilan',
/*             [
                'attribute' => 'perwakilan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::perwakilan,
                ],
                'value' => 'refPerwakilan.desc'
            ],
            //'nama',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ],
            ],
            //'jawatan',
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ],
                'value' => 'refJawatanJawatankuasaPemilihan.desc'
            ], */
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
