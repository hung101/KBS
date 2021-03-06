<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use yii\web\Session;

use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

use app\models\RefProgramSemasaSukanAtlet;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletAsetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

    $session = new Session;
    $session->open();

    $atlet_id = $session['atlet_id'];
    $atletModel = null;
    
    if (($atletModel = app\models\Atlet::findOne($atlet_id)) !== null) {
        $hantar = $atletModel->hantar;
    }

    $session->close();

$this->title = GeneralLabel::aset;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-aset-index">
    
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
            <?= Html::button('Tambah Aset', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabAsetID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listAsetID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listAsetID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'aset_id',
            //'atlet_id',
            //'jenis_aset',
            [
                'attribute' => 'jenis_aset',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_aset,
                ],
                'value' => 'jenisAset.desc'
            ],
            // 'daftar_no_pengangkutan',
            //'jenis_harta_pengangkutan_perniagaan',
            [
                'attribute' => 'jenis_harta_pengangkutan_perniagaan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_harta_pengangkutan_perniagaan,
                ],
                'value' => 'jenisAsetSub.desc'
            ],
            [
                'attribute' => 'nilai_harta_pengangkutan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nilai_harta_pengangkutan,
                ]
            ],
            // 'daftar_alamat',
            // 'nama_syarikat_perniagaan',
            // 'produk_perkhidmatan_perniagaan',
            // ,
            // ,
            // ,
            // ,

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabAsetID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabAsetID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabAsetID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
