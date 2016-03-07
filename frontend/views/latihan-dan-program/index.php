<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LatihanDanProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Latihan Dan Pendidikan Badan Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="latihan-dan-program-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Latihan Dan Pendidikan Badan Sukan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'latihan_dan_program_id',
            //'kategori_kursus',
            [
                'attribute' => 'kategori_kursus',
                'value' => 'refKategoriKursus.desc'
            ],
            'nama_kursus',
            //'tarikh_kursus',
            [
                'attribute' => 'tarikh_kursus',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_kursus);
                },
            ],
            'lokasi_kursus',
            'penganjuran_kursus',
            // 'bilangan_ahli_yang_menyertai',

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
