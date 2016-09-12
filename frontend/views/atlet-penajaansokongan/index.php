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

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletPenajaansokonganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::atlet_penajaansokongans;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-penajaansokongan-index">
    
    <?php
        $session = new Session;
        $session->open();
        
        $template = '{view}';
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ){
            $template .= ' {update}';
        }
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ){
            $template .= ' {delete}';
        }
        
        $session->close();
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ): ?>
        <p>
            <?= Html::button(GeneralLabel::createTitle .' '.GeneralLabel::atlet_penajaansokongan, ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabPenajaanID.'");']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*[
                'attribute' => 'penajaan_sokongan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penajaan_sokongan_id,
                ]
            ],
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ]
            ],*/
            [
                'attribute' => 'nama_syarikat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_syarikat,
                ]
            ],
            /*[
                'attribute' => 'alamat_1',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat_1,
                ]
            ],*/
            [
                'attribute' => 'nilai_kontrak',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nilai_kontrak,
                ]
            ],
            [
                'attribute' => 'tahun_permulaan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_permulaan,
                ]
            ],
            [
                'attribute' => 'tahun_akhir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_akhir,
                ]
            ],
            [
                'attribute' => 'barang_yang_penyokong',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::barang_yang_penyokong,
                ]
            ],
            /*[
                'attribute' => 'emel',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::emel,
                ]
            ],*/
            // 'no_telefon',
            // 'peribadi_yang_bertanggungjawab',
            // 'jenis_kontrak',
            // 'nilai_kontrak',
            // 'tahun_permulaan',
            // 'tahun_akhir',
            // 'barang_yang_penyokong',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabPenajaanID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabPenajaanID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabPenajaanID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
