<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use yii\web\Session;

use app\models\RefProgramSemasaSukanAtlet;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

    $session = new Session;
    $session->open();

    $atlet_id = $session['atlet_id'];
    $atletModel = null;
    
    if (($atletModel = app\models\Atlet::findOne($atlet_id)) !== null) {
        $hantar = $atletModel->hantar;
    }

    $session->close();

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::nama_acara_program;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-index">
    <?php
        $session = new Session;
        $session->open();
        
        $template = '{view}';
        
        if( ((( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))) &&  $hantar == 0) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['kemaskini_yang_hantar'])  ){
            $template .= ' {update}';
        }
        
        if( ((( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))) &&  $hantar == 0) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['kemaskini_yang_hantar'])  ){
            $template .= ' {delete}';
        }
        
        $session->close();
    ?>
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if( ((( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))) &&  $hantar == 0) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['kemaskini_yang_hantar'])  ): ?>
        <p>
            <?= Html::button(GeneralLabel::createTitle . ' ' . GeneralLabel::nama_acara_program, ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabSukanID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listSukanID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listSukanID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sukan_id',
            //'atlet_id',
            //'program_semasa',
            [
                'attribute' => 'program_semasa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program_semasa,
                ],
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'acara',
            [
                'attribute' => 'acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::acara,
                ],
                'value' => 'refAcara.desc'
            ],
            // 'tahun_umur_permulaan',
            // 'tahun_menyertai_program_msn',
            
            // 'no_lesen_sukan',
            // 'atlet_persekutuan_dunia_id',
            [
                'attribute' => 'tarikh_mula_menyertai_program_msn',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula_menyertai_program_msn,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula_menyertai_program_msn, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'tarikh_tamat_menyertai_program_msn',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat_menyertai_program_msn,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat_menyertai_program_msn, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'jurulatih_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jurulatih,
                ],
                'value' => 'refJurulatih.nama'
            ],
            /*[
                'attribute' => 'profil_pusat_latihan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pusat_latihan,
                ],
                'value' => 'refPusatLatihan.nama_pusat_latihan'
            ],*/

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabSukanID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabSukanID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabSukanID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>
