<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SukarelawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::sukarelawan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sukarelawan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::sukarelawan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sukarelawan_id',
            'nama',
            //'no_kad_pengenalan',
           // 'alamat_1',
            //'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
             
            // 'alamat_poskod',
            // 'tarikh_lahir',
            //'jantina',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            //'alamat_bandar',
            [
                'attribute' => 'alamat_bandar',
                'value' => 'refBandar.desc'
            ],
            // 'no_tel_bimbit',
            // 'status',
            // 'emel',
            // 'facebook',
            // 'kebatasan_fizikal',
            // 'menyatakan_jika_ada_kebatasan_fizikal',
            // 'kelulusan_akademi',
            // 'bidang_kepakaran',
            // 'pekerjaan_semasa',
            // 'nama_majikan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',
            // 'bidang_diminati',
            // 'waktu_ketika_diperlukan',
            // 'menyatakan_waktu_ketika_diperlukan',
            // 'muatnaik',

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
