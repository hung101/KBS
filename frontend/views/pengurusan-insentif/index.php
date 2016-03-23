<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanInsentifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_insentif;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_insentif, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_insentif_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'atlet.name_penuh'
            ],
            //'nama_insentif',
            [
                'attribute' => 'nama_insentif',
                'value' => 'refNamaInsentif.desc'
            ],
            //'kumpulan',
            [
                'attribute' => 'kumpulan',
                'value' => 'refKumpulan.desc'
            ],
            //'rekod_baru',
            [
                'attribute' => 'rekod_baru',
                'value' => 'refRekodBaru.desc'
            ],
            // 'nama_sukan',
            // 'kelayakan_pingat',
            // 'jumlah_insentif',
            // 'sgar_nama_jurulatih',
            // 'jumlah_sgar',
            // 'sikap_nama_persatuan',
            // 'jumlah_sikap',
            // 'siso_tarikh_kelayakan',
            // 'sisi_tarikh_olimpik',
            // 'jumlah_siso',
            // 'sito_nama_acara_di_olimpik',
            // 'sito_pingat',
            // 'jumlah_sito',
            // 'category_insentif',
            // 'kelulusan',

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
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
