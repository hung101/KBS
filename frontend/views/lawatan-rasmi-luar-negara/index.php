<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LawatanRasmiLuarNegaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::lawatan_rasmi_luar_negara;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lawatan-rasmi-luar-negara-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['lawatan-rasmi-luar-negara']['update'])){
            //$template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['lawatan-rasmi-luar-negara']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['lawatan-rasmi-luar-negara']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::lawatan_rasmi_luar_negara, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'lawatan_rasmi_luar_negara_id',
            //'lawatan',
            [
                'attribute' => 'lawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::lawatan,
                ],
                'value' => 'refLawatan.desc'
            ],
            //'negara',
            [
                'attribute' => 'negara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::negara,
                ],
                'value' => 'refNegara.desc'
            ],
            //'tarikh',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            //'delegasi:ntext',
            //'jumlah_delegasi',
            [
                'attribute' => 'jumlah_delegasi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_delegasi,
                ]
            ],
            // 'nama_pegawai_terlibat:ntext',
            // 'catatan:ntext',
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
