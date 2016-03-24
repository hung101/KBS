<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenganjuranKursusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penganjuran_kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cce, 'url' => ['kursus/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::penganjuran_kursus, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penganjuran_kursus_id',
            //'tarikh_kursus',
            [
                'attribute' => 'tarikh_kursus_mula',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_kursus_mula);
                },
            ],
            'tempat_kursus',
            //'negeri',
            [
                'attribute' => 'negeri',
                'value' => 'refNegeri.desc'
            ],
            //'nama_penyelaras',
            // 'no_telefon',
            // 'kuota_kursus',

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
