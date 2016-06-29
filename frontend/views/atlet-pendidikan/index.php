<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletPendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pendidikan;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="atlet-pendidikan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])): ?>
        <p>
            <?= Html::button('Tambah Pendidikan', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabPendidikanID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listPendidikanID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listPendidikanID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'jenis_peringkatan_pendidikan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_peringkatan_pendidikan,
                ],
                'value' => 'tahapPendidikan.desc'
            ],
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'jenis_pencapaian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_pencapaian,
                ],
                'value' => 'refJenisPencapaian.desc'
            ],
            //'pendidikan_atlet_id',
            //'atlet_id',
            //'jenis_peringkatan_pendidikan',
            
            /*[
                'attribute' => 'kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kursus,
                ]
            ],*/
            //'fakulti',
            // 'alamat_1',
            // 'no_telefon',
            /*[
                'attribute' => 'tahun_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_mula,
                ]
            ],
            [
                'attribute' => 'tahun_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_tamat,
                ]
            ],*/
            // 'pelajar_id_no',
            // 'keputusan_cgpa',
            // 'biasiswa_tajaan',
            // 'jenis_biasiswa',
            // 'jumlah_biasiswa',
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
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabPendidikanID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabPendidikanID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabPendidikanID.'");',
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
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabPembangunanKaunselingID.'");']) ?>
    </p>-->
    
    <!-- Kaunseling Rekod - START -->
    <div class="panel panel-default copyright-wrap" id="penukaran_rekods-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#penukaran_rekods-body">Rekod Penukaran / Penangguhan / Pelepasan Sekolah</a>
            <button type="button" class="close" data-target="#penukaran_rekods-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="penukaran_rekods-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPP,
            //'filterModel' => $searchModelPP,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            //'sebab_pemohonan',
            //'kategori_pengajian',
            [
                'attribute' => 'sebab_pemohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sebab_pemohonan,
                ],
                'value' => 'refSebabPermohonanPertukaranPengajian.desc'
            ],
            [
                'attribute' => 'created',
                'label' => GeneralLabel::tarikh,
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->created){
                        return date('Y-m-d',strtotime($model->created));
                    } else {
                        return '';
                    }
                },
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/permohonan-bimbingan-kaunseling/view', 'id' => $model->permohonan_bimbingan_kaunseling_id]), 'class' => 'custom_button']);
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