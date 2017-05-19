<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PerancanganProgramPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pelan_periodisasi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perancangan-program-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::pelan_periodisasi, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'perancangan_program_id',
            [
                'attribute' => 'cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cawangan             ],
                    'value' => 'refCawangan.desc'
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                    'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat);
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                    'print' => function ($url, $model) {
                        return  ($model->perancangan_program_plan_master_id) ? Html::a('<span class="glyphicon glyphicon-list-alt"></span>', 
                        ['perancangan-program-plan/laporan-pelan-periodisasi', 'id' =>$model->perancangan_program_plan_master_id], 
                        [
                            'title' => GeneralLabel::laporan_pelan_periodisasi,
                            'target' => '_blank',
                            'class' => 'custom_button',
                            'value'=>Url::to(['/perancangan-program-plan/laporan-pelan-periodisasi', 'id' => $model->perancangan_program_plan_master_id])
                        ]) : '';
                    },
                ],
                'template' => $template . ' {print}',
            ],
        ],
    ]); ?>

</div>
