<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JurulatihSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::sukan_dan_program;
$this->params['breadcrumbs'][] = $this->title;

use yii\web\Session;

    $session = new Session;
    $session->open();

    $jurulatih_id = $session['jurulatih_id'];
    $jurulatihModel = null;
    
    if (($jurulatihModel = app\models\Jurulatih::findOne($jurulatih_id)) !== null) {
        $approved = $jurulatihModel->approved;
    }

    $session->close();
?>
<div class="jurulatih-sukan-index">
    
    <?php
        $template = '';
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['papar-gaji'])){
        $template = '{view}';
        }
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])){
            //$template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php if(((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['create']) && Yii::$app->user->identity->peranan !=  32) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
        <p>
            <?= Html::button(GeneralLabel::createTitle . ' ' . GeneralLabel::sukan_dan_program, ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabSukanJurulatihID.'");']) ?>
        </p>
    <?php endif; ?>
        
    <?php Pjax::begin(['id' => GeneralVariable::listSukanJurulatihID, 'timeout' => false, 'enablePushState' => false,]); ?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_sukan_id',
            //'jurulatih_id',
            ////'bahagian',
            [
                'attribute' => 'bahagian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bahagian,
                ],
                'value' => 'refBahagianJurulatih.desc',
            ],
            //'program',
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgramJurulatih.desc'
            ],
            //'sukan',
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'cawangan',
            
            // 'tarikh_mula_lantikan',
            [
                'attribute' => 'tarikh_mula_lantikan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula_lantikan,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula_lantikan);
                },
            ],
            // 'tarikh_tamat_lantikan',
            [
                'attribute' => 'tarikh_tamat_lantikan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat_lantikan,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat_lantikan);
                },
            ],
            // 'gaji_elaun',
            [
                'attribute' => 'gaji_elaun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::gaji_elaun,
                ],
                'value' => 'refGajiElaunJurulatih.desc',
                'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['papar-gaji']),
            ],
            // 'jumlah',
            [
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ],
                'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['papar-gaji']),
            ],
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabSukanJurulatihID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabSukanJurulatihID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabSukanJurulatihID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
        
        
    <?php Pjax::end(); ?>
</div>
