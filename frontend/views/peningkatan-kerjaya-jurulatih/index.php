<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PeningkatanKerjayaJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::peningkatan_kerjaya_jurulatih;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peningkatan-kerjaya-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Peningkatan Kerjaya Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'peningkatan_kerjaya_jurulatih_id',
            [
                'attribute' => 'nama_jurulatih',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jurulatih,
                ]
            ],
            [
                'attribute' => 'cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cawangan,
                ]
            ],
            [
                'attribute' => 'sub_cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sub_cawangan,
                ]
            ],
            //'program_msn',
            // 'lain_lain_program',
            // 'pusat_latihan',
            // 'nama_sukan',
            // 'nama_acara',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
