<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\Session;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JurulatihSukanAcaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurulatih Sukan Acaras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-sukan-acara-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurulatih Sukan Acara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_sukan_acara_id',
            //'jurulatih_sukan_id',
            //'acara',
            [
                'attribute' => 'acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::acara,
                ],
                'value' => 'refAcara.desc'
            ],
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordSubModalAjax("'.Url::to(['jurulatih-sukan-acara/delete', 'id' => $model->jurulatih_sukan_acara_id]).'", "'.GeneralMessage::confirmDelete.'", "acaraGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-sukan-acara/update', 'id' => $model->jurulatih_sukan_acara_id]).'", "'.GeneralLabel::updateTitle . ' Acara");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-sukan-acara/view', 'id' => $model->jurulatih_sukan_acara_id]).'", "'.GeneralLabel::viewTitle . ' Acara");',
                        ]);
                    }
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
</div>
