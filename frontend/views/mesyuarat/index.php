<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MesyuaratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mesyuarat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['update']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['delete']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['create']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Mesyuarat', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'mesyuarat_id',
            'nama_mesyuarat',
            'bil_mesyuarat',
            'tarikh',
            //'masa',
            'tempat',
            //'pengurusi',
            // 'pencatat_minit',
            // 'perkara_perkara_dan_tindakan',
            // 'mesyuarat_tamat',
            // 'mesyuarat_seterusnya',
            // 'disedia_oleh',
            // 'disemak_oleh',

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
