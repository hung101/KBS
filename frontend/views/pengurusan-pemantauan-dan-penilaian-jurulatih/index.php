<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanPemantauanDanPenilaianJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Penilaian Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            //'nama_jurulatih_dinilai',
            [
                'attribute' => 'nama_jurulatih_dinilai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jurulatih_dinilai,
                ],
                'value' => 'refJurulatih.nama'
            ],
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'nama_acara',
            [
                'attribute' => 'nama_acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_acara,
                ],
                'value' => 'refAcara.desc'
            ],
            //'pusat_latihan',

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
