<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\Jurulatih;
use app\models\RefKategoriPensijilanAkademiAkk;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefStatusJurulatihAkk;
use app\models\RefJantina;
use app\models\RefBangsa;
use app\models\RefKategoriJurulatih;
use app\models\RefStatusPerlesenanAkk;
use app\models\RefSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\AkademiAkk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akademi-akk-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
       /* echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'senarai_nama_peserta' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);*/
        ?>
    
    
    <?php
    if($model->muatnaik_gambar){
        echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->muatnaik_gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        if(!$readonly){
            echo Html::a(GeneralLabel::removeImage, ['deleteimg', 'id'=>$model->akademi_akk_id, 'field'=> 'muatnaik_gambar'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br><br>';
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'muatnaik_gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['accept' => 'image/*'], 'pluginOptions' => ['previewFileType' => 'image']],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'nama_jurulatih' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'no_passport' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>15]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jantina' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jantina/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJantina::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'bangsa' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bangsa/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBangsa::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bangsa],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                 'tarikh_lahir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options' => ['id'=>'TarikhLahirID'],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'jurulatih_di_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                //'tempat_lahir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
       [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'nama_majikan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'attributes' => [
                'alamat_majikan_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_majikan_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_majikan_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_majikan_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_majikan_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_majikan_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_majikan_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kategori_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriJurulatih::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'status_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-jurulatih-akk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusJurulatihAkk::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'kategori_pensijilan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pensijilan-akademi-akk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPensijilanAkademiAkk::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPensijilan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'status_perlesenan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-perlesenan-akk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPerlesenanAkk::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tahun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>4]],
            ],
        ],
    ]
]);
        ?>
    
    <!--<h3>Kegiatan/Pengalaman Sebagai Jurulatih</h3>
    
    
    
    <?php Pjax::begin(['id' => 'kegiatanPengalamanJurulatihAkkGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKegiatanPengalamanJurulatihAkk,
        //'filterModel' => $searchModelKegiatanPengalamanJurulatihAkk,
        'id' => 'kegiatanPengalamanJurulatihAkkGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kegiatan_pengalaman_jurulatih_akk_id',
            //'akademi_akk_id',
            'nama_sukan_pertandingan',
            'tahun',
            'peranan',
            //'peringkat',
            [
                'attribute' => 'peringkat',
                'value' => 'refPeringkatPengalamanJurulatih.desc'
            ],
            // 'persatuan_sukan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['kegiatan-pengalaman-jurulatih-akk/delete', 'id' => $model->kegiatan_pengalaman_jurulatih_akk_id]).'", "'.GeneralMessage::confirmDelete.'", "kegiatanPengalamanJurulatihAkkGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kegiatan-pengalaman-jurulatih-akk/update', 'id' => $model->kegiatan_pengalaman_jurulatih_akk_id]).'", "'.GeneralLabel::updateTitle . ' Kegiatan/Pengalaman Sebagai Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kegiatan-pengalaman-jurulatih-akk/view', 'id' => $model->kegiatan_pengalaman_jurulatih_akk_id]).'", "'.GeneralLabel::viewTitle . ' Kegiatan/Pengalaman Sebagai Jurulatih");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $akademi_akk_id = "";
        
        if(isset($model->akademi_akk_id)){
            $akademi_akk_id = $model->akademi_akk_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kegiatan-pengalaman-jurulatih-akk/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' Kegiatan/Pengalaman Sebagai Jurulatih");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <h3>Kegiatan/Pengalaman Atlet AKK</h3>
    
    <?php Pjax::begin(['id' => 'kegiatanPengalamanAtletAkkGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKegiatanPengalamanAtletAkk,
        //'filterModel' => $searchModelKegiatanPengalamanAtletAkk,
        'id' => 'kegiatanPengalamanAtletAkkGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kegiatan_pengalaman_atlet_akk_id',
            //'akademi_akk_id',
            'nama_sukan_pertandingan',
            'tahun',
            //'sukan_acara',
            [
                'attribute' => 'sukan_acara',
                'value' => 'refAcara.desc'
            ],
            // 'pencapaian',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['kegiatan-pengalaman-atlet-akk/delete', 'id' => $model->kegiatan_pengalaman_atlet_akk_id]).'", "'.GeneralMessage::confirmDelete.'", "kegiatanPengalamanAtletAkkGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kegiatan-pengalaman-atlet-akk/update', 'id' => $model->kegiatan_pengalaman_atlet_akk_id]).'", "'.GeneralLabel::updateTitle . ' Kegiatan/Pengalaman Atlet AKK");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kegiatan-pengalaman-atlet-akk/view', 'id' => $model->kegiatan_pengalaman_atlet_akk_id]).'", "'.GeneralLabel::viewTitle . ' Kegiatan/Pengalaman Atlet AKK");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
    <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kegiatan-pengalaman-atlet-akk/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' Kegiatan/Pengalaman Atlet AKK");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <h3>Kelayakan Akademi AKK</h3>
    
    <?php Pjax::begin(['id' => 'kelayakanAkademiAkkGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKelayakanAkademiAkk,
        //'filterModel' => $searchModelKelayakanAkademiAkk,
        'id' => 'kelayakanAkademiAkkGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kelayakan_akademi_akk_id',
            //'akademi_akk_id',
            'nama_peperiksaan',
            'tahun',
            'keputusan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['kelayakan-akademi-akk/delete', 'id' => $model->kelayakan_akademi_akk_id]).'", "'.GeneralMessage::confirmDelete.'", "kelayakanAkademiAkkGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kelayakan-akademi-akk/update', 'id' => $model->kelayakan_akademi_akk_id]).'", "'.GeneralLabel::updateTitle . ' Kelayakan Akademi AKK");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kelayakan-akademi-akk/view', 'id' => $model->kelayakan_akademi_akk_id]).'", "'.GeneralLabel::viewTitle . ' Kelayakan Akademi AKK");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
    <?php 
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kelayakan-akademi-akk/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' Kelayakan Akademi AKK");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>-->
    
    <h3><?=GeneralLabel::kelayakan_sukan_spesifik?></h3>
    
    <?php Pjax::begin(['id' => 'kelayakanSukanSpesifikAkkGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKelayakanSukanSpesifikAkk,
        //'filterModel' => $searchModelKelayakanSukanSpesifikAkk,
        'id' => 'kelayakanSukanSpesifikAkkGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kelayakan_sukan_spesifik_akk_id',
            //'akademi_akk_id',
            'nama_kursus',
            'tahap',
            'tahun_lulus',
            // 'persatuan_sukan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['kelayakan-sukan-spesifik-akk/delete', 'id' => $model->kelayakan_sukan_spesifik_akk_id]).'", "'.GeneralMessage::confirmDelete.'", "kelayakanSukanSpesifikAkkGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kelayakan-sukan-spesifik-akk/update', 'id' => $model->kelayakan_sukan_spesifik_akk_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::kelayakan_sukan_spesifik.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kelayakan-sukan-spesifik-akk/view', 'id' => $model->kelayakan_sukan_spesifik_akk_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::kelayakan_sukan_spesifik.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
    <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['kelayakan-sukan-spesifik-akk/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::kelayakan_sukan_spesifik.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <h3><?=GeneralLabel::sains_sukan?></h3>
    
    <?php Pjax::begin(['id' => 'pemohonKursusTahapAkkGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPemohonKursusTahapAkk,
        //'filterModel' => $searchModelPemohonKursusTahapAkk,
        'id' => 'pemohonKursusTahapAkkGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemohon_kursus_tahap_akk_id',
            //'akademi_akk_id',
            //'tahap',
            [
                'attribute' => 'tahap',
                'value' => 'refTahapSainsSukan.desc'
            ],
            'tahun_lulus',
            'no_sijil',
            // 'kod_kursus',
            // 'tempat',
            // 'muatnaik_sijil',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pemohon-kursus-tahap-akk/delete', 'id' => $model->pemohon_kursus_tahap_akk_id]).'", "'.GeneralMessage::confirmDelete.'", "pemohonKursusTahapAkkGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemohon-kursus-tahap-akk/update', 'id' => $model->pemohon_kursus_tahap_akk_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::sains_sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemohon-kursus-tahap-akk/view', 'id' => $model->pemohon_kursus_tahap_akk_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::sains_sukan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
    <?php 
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemohon-kursus-tahap-akk/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::sains_sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    <br>
    
    <pre style="text-align: center"><strong><?=GeneralLabel::sijil_tambahan_yang_dikehendaki_bagi_sukan_akuatik_sahaja?></strong></pre>
    
    <div class="panel panel-default">
        <div class="panel-body">
        
            <h3><?=GeneralLabel::sijil_pertolongan_cemas?></h3>

            <?php Pjax::begin(['id' => 'akkSijilPertolonganCemasGrid', 'timeout' => 100000]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProviderAkkSijilPertolonganCemas,
                //'filterModel' => $searchModelAkkSijilPertolonganCemas,
                'id' => 'akkSijilPertolonganCemasGrid',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'akk_sijil_pertolongan_cemas_id',
                    //'akademi_akk_id',
                    'no_sijil',
                    'tahap',
                    'tahun',
                    // 'sijil',
                    [
                        'attribute' => 'sijil',
                        'format' => 'raw',
                        'value'=>function ($model) {
                            if($model->sijil){
                                //return Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->sijil , ['target'=>'_blank']);
                                return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                                [ 
                                                    'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->sijil .'");'
                                                ]);
                            } else {
                                return "";
                            }
                        },
                    ],
                    // 'session_id',
                    // 'created_by',
                    // 'updated_by',
                    // 'created',
                    // 'updated',

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'Delete'),
                                'onclick' => 'deleteRecordModalAjax("'.Url::to(['akk-sijil-pertolongan-cemas/delete', 'id' => $model->akk_sijil_pertolongan_cemas_id]).'", "'.GeneralMessage::confirmDelete.'", "akkSijilPertolonganCemasGrid");',
                                //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                                ]);

                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'Update'),
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-sijil-pertolongan-cemas/update', 'id' => $model->akk_sijil_pertolongan_cemas_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::sijil_pertolongan_cemas .'");',
                                ]);
                            },
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'View'),
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-sijil-pertolongan-cemas/view', 'id' => $model->akk_sijil_pertolongan_cemas_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::sijil_pertolongan_cemas .'");',
                                ]);
                            }
                        ],
                        'template' => $template,
                    ],
                ],
            ]); ?>

            <?php if(!$readonly): ?>
            <p>
            <?php 
                echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-sijil-pertolongan-cemas/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::sijil_pertolongan_cemas .'");',
                                'class' => 'btn btn-success',
                                ]);?>
            </p>
            <?php endif; ?>

            <?php Pjax::end(); ?>

            <br>

            <h3><?=GeneralLabel::sijil_CPR?></h3>

            <?php Pjax::begin(['id' => 'akkSijilCprGrid', 'timeout' => 100000]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProviderAkkSijilCpr,
                //'filterModel' => $searchModelAkkSijilCpr,
                'id' => 'akkSijilCprGrid',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'akk_sijil_cpr_id',
                    //'akademi_akk_id',
                    'no_sijil',
                    'tahun',
                    'tarikh_tamat',
                    [
                        'attribute' => 'sijil',
                        'format' => 'raw',
                        'value'=>function ($model) {
                            if($model->sijil){
                                //return Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->sijil , ['target'=>'_blank']);
                                return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                                [ 
                                                    'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->sijil .'");'
                                                ]);
                            } else {
                                return "";
                            }
                        },
                    ],
                    // 'session_id',
                    // 'created_by',
                    // 'updated_by',
                    // 'created',
                    // 'updated',

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'Delete'),
                                'onclick' => 'deleteRecordModalAjax("'.Url::to(['akk-sijil-cpr/delete', 'id' => $model->akk_sijil_cpr_id]).'", "'.GeneralMessage::confirmDelete.'", "akkSijilCprGrid");',
                                //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                                ]);

                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'Update'),
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-sijil-cpr/update', 'id' => $model->akk_sijil_cpr_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::sijil_CPR .'");',
                                ]);
                            },
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'View'),
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-sijil-cpr/view', 'id' => $model->akk_sijil_cpr_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::sijil_CPR .'");',
                                ]);
                            }
                        ],
                        'template' => $template,
                    ],
                ],
            ]); ?>

            <?php if(!$readonly): ?>
            <p>
            <?php 
                echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-sijil-cpr/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::sijil_CPR .'");',
                                'class' => 'btn btn-success',
                                ]);?>
            </p>
            <?php endif; ?>

            <?php Pjax::end(); ?>

            <br>

            <h3><?=GeneralLabel::permit_kerja_jurulatih?></h3>

            <?php Pjax::begin(['id' => 'akkPermitKerjaGrid', 'timeout' => 100000]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProviderAkkPermitKerja,
                //'filterModel' => $searchModelAkkPermitKerja,
                'id' => 'akkPermitKerjaGrid',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'akk_permit_kerja_id',
                    //'akademi_akk_id',
                    'no_permit',
                    'tahun',
                    //'tarikh_tamat',
                    [
                        'attribute' => 'tarikh_tamat',
                        'format' => 'raw',
                        'value'=>function ($model) {
                            return GeneralFunction::convert($model->tarikh_tamat);
                        },
                    ],
                    [
                        'attribute' => 'permit',
                        'format' => 'raw',
                        'value'=>function ($model) {
                            if($model->permit){
                                return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                                [ 
                                                    'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->permit .'");'
                                                ]);
                            } else {
                                return "";
                            }
                        },
                    ],
                    // 'session_id',
                    // 'created_by',
                    // 'updated_by',
                    // 'created',
                    // 'updated',

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'Delete'),
                                'onclick' => 'deleteRecordModalAjax("'.Url::to(['akk-permit-kerja/delete', 'id' => $model->akk_permit_kerja_id]).'", "'.GeneralMessage::confirmDelete.'", "akkPermitKerjaGrid");',
                                //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                                ]);

                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'Update'),
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-permit-kerja/update', 'id' => $model->akk_permit_kerja_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::permit_kerja_jurulatih .'");',
                                ]);
                            },
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                                'title' => Yii::t('yii', 'View'),
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-permit-kerja/view', 'id' => $model->akk_permit_kerja_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::permit_kerja_jurulatih .'");',
                                ]);
                            }
                        ],
                        'template' => $template,
                    ],
                ],
            ]); ?>

            <?php if(!$readonly): ?>
            <p>
            <?php 
                echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['akk-permit-kerja/create', 'akademi_akk_id' => $akademi_akk_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::permit_kerja_jurulatih .'");',
                                'class' => 'btn btn-success',
                                ]);?>
            </p>
            <?php endif; ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
    
    <br>
    <br>
    
    <pre style="text-align: center"><strong>UNTUK KEGUNAAN PENGELUARAN LESEN<?=GeneralLabel::untuk_kegunaan_pengeluaran_lesen?></strong></pre>
    
    <div class="panel panel-default">
        <div class="panel-body">
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_terima_borang' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 'no_lesen_jurulatih' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula_lesen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat_lesen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'no_sijil_spkk' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>30]],
            ]
        ],
    ]
]);
    ?>
            </div>
    </div>

    <!--<?= $form->field($model, 'nama')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'muatnaik_gambar')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'no_kad_pengenalan')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'no_passport')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'tarikh_lahir')->textInput() ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'no_telefon')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'emel')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nama_majikan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'alamat_majikan_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_majikan_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_majikan_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_majikan_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_majikan_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_majikan_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'no_telefon_pejabat')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'kategori_pensijilan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#jurulatihId').change(function(){
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        clearForm();
        //$('#ahliJawatanKecilBiro').attr('value','');
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#akademiakk-nama_jurulatih').attr('value',data.nama);
            $('#akademiakk-no_kad_pengenalan').attr('value',data.ic_no);
            $('#akademiakk-no_passport').attr('value',data.passport_no);
            $("#akademiakk-jantina").val(data.jantina).trigger("change");
            $("#akademiakk-bangsa").val(data.bangsa).trigger("change");
        
            var DOBVal = data.tarikh_lahir;
            $("#TarikhLahirID-disp").val(formatDisplayDate(DOBVal));
            $("#TarikhLahirID").val(formatSaveDate(DOBVal));
        
            $('#akademiakk-alamat_1').attr('value',data.alamat_rumah_1);
            $('#akademiakk-alamat_2').attr('value',data.alamat_rumah_2);
            $('#akademiakk-alamat_3').attr('value',data.alamat_rumah_3);
            $('#akademiakk-alamat_negeri').val(data.alamat_rumah_negeri).trigger("change");
            $('#akademiakk-alamat_bandar').val(data.alamat_rumah_bandar).trigger("change");
            $('#akademiakk-alamat_poskod').attr('value',data.alamat_rumah_poskod);
            $('#akademiakk-no_telefon').attr('value',data.no_telefon);
            $('#akademiakk-emel').attr('value',data.emel);
            $('#akademiakk-no_telefon_pejabat').attr('value',data.no_telefon_pejabat);
            $('#akademiakk-nama_majikan').attr('value',data.nama_majikan);
            $('#akademiakk-alamat_majikan_1').attr('value',data.alamat_majikan_1);
            $('#akademiakk-alamat_majikan_2').attr('value',data.alamat_majikan_2);
            $('#akademiakk-alamat_majikan_3').attr('value',data.alamat_majikan_3);
            $('#akademiakk-alamat_majikan_negeri').val(data.alamat_majikan_negeri).trigger("change");
            $('#akademiakk-alamat_majikan_bandar').val(data.alamat_majikan_bandar).trigger("change");
            $('#akademiakk-alamat_majikan_poskod').attr('value',data.alamat_majikan_poskod);
        
            if(data.badanSukan !== null){ 
                $('#latihandanprogrampeserta-nama_badan_sukan').attr('value',data.badanSukan.profil_badan_sukan);
                $('#latihandanprogrampeserta-no_pendaftaran_sukan').attr('value',data.badanSukan.no_pendaftaran);
            }

            if(data.refJawatanInduk !== null) 
                $('#latihandanprogrampeserta-jawatan').attr('value',data.refJawatanInduk.desc);

            }
        });
});
     
function clearForm(){
    $('#akademiakk-nama_jurulatih').attr('value','');
    $('#akademiakk-no_kad_pengenalan').attr('value','');
    $('#akademiakk-no_passport').attr('value','');
    $("#akademiakk-jantina").val('').trigger("change");
    $("#akademiakk-bangsa").val('').trigger("change");

    $("#TarikhLahirID-disp").val('');
    $("#TarikhLahirID").val('');

    $('#akademiakk-alamat_1').attr('value','');
    $('#akademiakk-alamat_2').attr('value','');
    $('#akademiakk-alamat_3').attr('value','');
    $('#akademiakk-alamat_negeri').val('').trigger("change");
    $('#akademiakk-alamat_bandar').val('').trigger("change");
    $('#akademiakk-alamat_poskod').attr('value','');
    $('#akademiakk-no_telefon').attr('value','');
    $('#akademiakk-emel').attr('value','');
    $('#akademiakk-no_telefon_pejabat').attr('value','');
    $('#akademiakk-nama_majikan').attr('value','');
    $('#akademiakk-alamat_majikan_1').attr('value','');
    $('#akademiakk-alamat_majikan_2').attr('value','');
    $('#akademiakk-alamat_majikan_3').attr('value','');
    $('#akademiakk-alamat_majikan_negeri').val('').trigger("change");
    $('#akademiakk-alamat_majikan_bandar').val('').trigger("change");
    $('#akademiakk-alamat_majikan_poskod').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
