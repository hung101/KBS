<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FarmasiPermohonanUbatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Ubatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-ubatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Permohonan Ubatan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'farmasi_permohonan_ubatan_id',
            //'atlet_id',
            'tarikh_pemberian',
            'pegawai_yang_bertanggungjawab',
            // 'catitan_ringkas',
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
                'value' => 'refKelulusan.desc'
            ],

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
