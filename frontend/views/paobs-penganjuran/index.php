<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaobsPenganjuranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penganjuran_acara_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjuran-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::penganjuran_acara_sukan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penganjuran_id',
            [
                'attribute' => 'nama_aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_aktiviti,
                ]
            ],
            //'jenis_sukan',
            [
                'attribute' => 'jenis_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'tarikh_aktiviti',
            [
                'attribute' => 'tarikh_aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_aktiviti,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_aktiviti);
                },
            ],
            [
                'attribute' => 'alamat_lokasi_1',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat_lokasi_1,
                ]
            ],
            //'pemilik_lokasi',
            // 'bilangan_peserta',
            // 'negara_peserta',
            // 'kos_aktiviti',
            // 'sumber_kewangan',
            // 'surat_sokongan',
            // 'laporan_penganjuran',

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
