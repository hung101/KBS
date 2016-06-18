<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ManualSilibusKurikulumTeknikalKepegawaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manual-silibus-kurikulum-teknikal-kepegawaian-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['manual-silibus-kurikulum-teknikal-kepegawaian']['update']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['manual-silibus-kurikulum-teknikal-kepegawaian']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['manual-silibus-kurikulum-teknikal-kepegawaian']['delete']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['manual-silibus-kurikulum-teknikal-kepegawaian']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['manual-silibus-kurikulum-teknikal-kepegawaian']['create']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['manual-silibus-kurikulum-teknikal-kepegawaian']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'manual_silibus_kurikulum_teknikal_kepegawaian_id',
            'persatuan_sukan',
            'jilid_versi',
            'tarikh',
            'muat_naik',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

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
