<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PemohonKursusTahapAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::sains_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemohon-kursus-tahap-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Sains Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemohon_kursus_tahap_akk_id',
            //'akademi_akk_id',
            [
                'attribute' => 'tahap',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahap,
                ]
            ],
            [
                'attribute' => 'tahun_lulus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_lulus,
                ]
            ],
            [
                'attribute' => 'no_sijil',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_sijil,
                ]
            ],
            // 'kod_kursus',
            // 'tempat',
            // 'muatnaik_sijil',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
