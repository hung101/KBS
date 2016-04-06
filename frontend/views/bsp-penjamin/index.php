<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPenjaminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penjamin_biasiswa_sukan_persekutuan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Penjamin Biasiswa Sukan Persekutuan', Url::to(['create', 'bsp_pemohon_id' => $bsp_pemohon_id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_penjamin_id',
            //'bsp_pemohon_id',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ]
            ],
            // 'alamat_tetap_1',
            // 'alamat_tetap_2',
            // 'alamat_tetap_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'no_telefon_rumah',
            // 'no_telefon_pejabat',
            // 'no_telefon_bimbit',
            // 'email:email',
            // 'alamat_pejabat_1',
            // 'alamat_pejabat_2',
            // 'alamat_pejabat_3',
            // 'alamat_pejabat_negeri',
            // 'alamat_pejabat_bandar',
            // 'alamat_pejabat_poskod',

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
