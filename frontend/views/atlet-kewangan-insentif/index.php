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
/* @var $searchModel app\models\AtletKewanganInsentifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::insentif;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-insentif-index">
    
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
            <?= Html::button(GeneralLabel::createTitle . ' Insentif', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabKewanganInsentifID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listKewanganInsentifID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listKewanganInsentifID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'insentif_id',
            //'atlet_id',
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ]
            ],
            //'jenis_insentif',
            [
                'attribute' => 'jenis_insentif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_insentif,
                ],
                'value' => 'refJenisInsentif.desc'
            ],
            [
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ]
            ],
            //'pertandingan',
            [
                'attribute' => 'pencapaian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pencapaian,
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabKewanganInsentifID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabKewanganInsentifID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabKewanganInsentifID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
        
        <br>
        <br>
        
    <!--<p>
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKewanganInsentifID.'");']) ?>
    </p>-->
    
    <!-- Kaunseling Rekod - START -->
    <div class="panel panel-default copyright-wrap" id="penukaran_rekods-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#penukaran_rekods-body">Rekod Insentif</a>
            <button type="button" class="close" data-target="#penukaran_rekods-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="penukaran_rekods-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPI,
            //'filterModel' => $searchModelPI,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kejohanan,
                ],
            ],
            //'jenis_insentif',
            [
                'attribute' => 'jenis_insentif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_insentif,
                ],
                'value' => 'refJenisInsentif.desc'
            ],
            //'pingat',
            [
                'attribute' => 'pingat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pingat,
                ],
                'value' => 'refPingatInsentif.desc'
            ],
            //'kumpulan_temasya_kejohanan',
            [
                'attribute' => 'kumpulan_temasya_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kumpulan_temasya_kejohanan,
                ],
                'value' => 'refPengurusanInsentifTetapanShakamShakar.kumpulan_temasya_kejohanan'
            ],
            // 'rekod_baharu',
            //'jumlah',
            [
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ],
            ],
            //'kelulusan',
            [
                'attribute' => 'kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelulusan,
                ],
                'value' => 'refKelulusan.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/pembayaran-insentif/view', 'id' => $model->pembayaran_insentif_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Kaunseling Rekod - END -->
</div>




<?php
$script = <<< JS
        
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});
     

JS;
        
$this->registerJs($script);
?>

</div>
