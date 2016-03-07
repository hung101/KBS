<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AtletPencapaianRekodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atlet Pencapaian Rekods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-rekods-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Atlet Pencapaian Rekods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'id' => 'keputusanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pencapaian_rekods_id',
            //'pencapaian_id',
            'tarikh',
            'peringkat',
            'opponent',
            'venue',
            //'jenis_rekod',
            [
                'attribute' => 'jenis_rekod',
                'value' => 'refJenisRekod.desc'
            ],
            'result',
            //'personal_best',
            //'season_best',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordSubModalAjax("'.Url::to(['atlet-pencapaian-rekods/delete', 'id' => $model->pencapaian_rekods_id]).'", "'.GeneralMessage::confirmDelete.'", "keputusanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['atlet-pencapaian-rekods/update', 'id' => $model->pencapaian_rekods_id]).'", "'.GeneralLabel::updateTitle . ' Keputusan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['atlet-pencapaian-rekods/view', 'id' => $model->pencapaian_rekods_id]).'", "'.GeneralLabel::viewTitle . ' Keputusan");',
                        ]);
                    }
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
