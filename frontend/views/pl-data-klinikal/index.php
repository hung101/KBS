<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlDataKlinikalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Klinikal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-data-klinikal-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Data Klinikal', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_data_klinikal_id',
            //'atlet_id',
            'penglihatan_tanpa_cermin_mata_kiri',
            'penglihatan_tanpa_cermin_mata_kanan',
            'penglihatan_cermin_mata_kiri',
            // 'penglihatan_cermin_mata_kanan',
            // 'usia_kali_pertama_haid',
            // 'haid_kitaran',
            // 'status_haid',
            // 'haid_kali_terakhir_hari_pertama',
            // 'kali_terakhir_bersalin',
            // 'bilangan_kanak_kanak',
            // 'masalah_haid',
            // 'perokok_tempoh',
            // 'status_perokok',
            // 'alkohol',
            // 'jenis_alkohol',
            // 'diet_harian',
            // 'berat_badan_turun',
            // 'berat_badan_naik',

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
