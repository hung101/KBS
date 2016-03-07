<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanKejohananTemasyaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Kejohanan Temasya';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kejohanan-temasya-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Pengurusan Kejohanan Temasya', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_kejohanan_temasya_id',
            'nama_kejohanan_temasya',
            'tarikh_kejohanan',
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'value' => 'refSukan.desc'
            ],
            //'nama_acara',
            [
                'attribute' => 'nama_acara',
                'value' => 'refAcara.desc'
            ],
            //'lokasi_kejohanan',
            // 'nama_ketua_kontijen',
            // 'nama_atlet',
            // 'nama_pegawai',
            // 'nama_doktor',
            // 'nama_fisio',
            // 'tarikh_penginapan_mula',
            // 'tarikh_penginapan_akhir',
            // 'tarikh_perjalanan_pesawat',
            // 'tarikh_pulang_perjalanan_pesawat',
            // 'catatan_pesawat',

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
