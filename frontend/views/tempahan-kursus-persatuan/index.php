<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TempahanKursusPersatuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tempahan Kursus Persatuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kursus-persatuan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Tempahan Kursus Persatuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tempahan_kursus_persatuan_id',
            //'kursus_persatuan_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'jenis_tempahan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_tempahan,
                ]
            ],
            [
                'attribute' => 'unit_tempahan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::unit_tempahan,
                ]
            ],
            // 'kos_tempahan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
