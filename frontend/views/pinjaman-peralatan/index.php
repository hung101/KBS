<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PinjamanPeralatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjaman Peralatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-peralatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Pinjaman Peralatan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pinjaman_peralatan_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'refAtlet.name_penuh'
            ],
            //'nama_peralatan',
            [
                'attribute' => 'nama_peralatan',
                'value' => 'refPeralatanPinjaman.desc'
            ],
            'kuantiti',
            //'tarikh_diberi',
            [
                'attribute' => 'tarikh_diberi',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_diberi, GeneralFunction::TYPE_DATETIME);
                },
            ],
            //'tarikh_dipulang',
            [
                'attribute' => 'tarikh_dipulang',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_dipulang, GeneralFunction::TYPE_DATETIME);
                },
            ],
            // 'tempoh_pinjaman',

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
