<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspKedudukanKewanganPenjaminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kedudukan Kewangan Penjamin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Kedudukan Kewangan Penjamin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_kedudukan_kewangan_penjamin_id',
            //'bsp_penjamin_id',
            'pendapatan_bulanan',
            'pinjaman_perumahan_baki_terkini',
            'sebagai_penjamin_siberhutang',
            // 'lain_lain_pinjaman_tanggungan',
            // 'perkerjaan',
            // 'nama_alamat_majikan',
            // 'nama_isteri_suami',
            // 'no_kp_isteri_suami',
            // 'jumlah_anak',
            // 'pertalian_keluarga_dengan_pelajar',
            // 'pelajar_lain_selain_daripada_penerima_di_atas',

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
