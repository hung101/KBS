<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\Session;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JurulatihKesihatanMasalahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurulatih Kesihatan Masalahs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-kesihatan-masalah-index">
    
    <?php
        $template = '{view}';

        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])){
            $template .= ' {update}';
        }

        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <!--<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurulatih Kesihatan Masalah', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_kesihatan_kesihatan_id',
            //'jurulatih_kesihatan_id',
            //'masalah_kesihatan',
            [
                'attribute' => 'masalah_kesihatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::masalah_kesihatan,
                ],
                'value' => 'refMasalahKesihatan.desc'
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
                        'onclick' => 'deleteRecordSubModalAjax("'.Url::to(['jurulatih-kesihatan-masalah/delete', 'id' => $model->jurulatih_kesihatan_kesihatan_id]).'", "'.GeneralMessage::confirmDelete.'", "masalahGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-kesihatan-masalah/update', 'id' => $model->jurulatih_kesihatan_kesihatan_id]).'", "'.GeneralLabel::updateTitle . ' Acara");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-kesihatan-masalah/view', 'id' => $model->jurulatih_kesihatan_kesihatan_id]).'", "'.GeneralLabel::viewTitle . ' Acara");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
</div>
