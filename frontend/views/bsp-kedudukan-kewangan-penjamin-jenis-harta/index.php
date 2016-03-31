<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspKedudukanKewanganPenjaminJenisHartaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kedudukan Kewangan Penjamin (Jenis Harta)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Kedudukan Kewangan Penjamin (Jenis Harta)', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_kedudukan_kewangan_penjamin_jenis_harta_id',
            //'bsp_kedudukan_kewangan_penjamin_id',
            //'jenis_harta',
            [
                'attribute' => 'jenis_harta',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_harta,
                ],
                'value' => 'refJenisHarta.desc'
            ],
            [
                'attribute' => 'jumlah_ekar_kaki_persegi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_ekar_kaki_persegi,
                ]
            ],
            [
                'attribute' => 'nilai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nilai,
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
