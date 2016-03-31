<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SenaraiHargaPerkhidmatanUbatanPeralatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Harga Perkhidmatan/Ubatan/Peralatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-harga-perkhidmatan-ubatan-peralatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['delete'])){
            $template .= ' {delete}';
        }
    ?>
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Perkhidmatan/Ubatan/Peralatan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_harga_perkhidmatan_ubatan_peralatan_id',
            [
                'attribute' => 'nama_perkhidmatan_ubatan_peralatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_perkhidmatan_ubatan_peralatan,
                ]
            ],
            [
                'attribute' => 'harga',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::harga,
                ]
            ],
            [
                'attribute' => 'catitan_ringkas',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::catitan_ringkas,
                ]
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
