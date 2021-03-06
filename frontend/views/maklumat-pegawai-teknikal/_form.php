<?php


use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefTahapAkademikPegawaiTeknikal;
use app\models\RefJawatanPengawaiTeknikal;
use app\models\RefKategoriPengawaiTeknikal;
use app\models\RefProgramPengawaiTeknikal;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;
/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-pegawai-teknikal-form">
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
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
                'badan_sukan' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/profil-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                        'options' => ['placeholder' => Placeholder::persatuan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                 'sukan' => [
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
                        'data'=>ArrayHelper::map(GeneralFunction::getSukan(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'jawatan_pengawai' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jawatan-pengawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJawatanPengawaiTeknikal::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jawatan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
    ]
]);
    ?>
    
    <pre style="text-align: center; background-color: #a5a5a5;"><strong><?php echo GeneralLabel::maklumat_diri_cap; ?></strong></pre>
    
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
                'nama' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                'no_kad_pengenalan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'id'=>'noKadPengenalanId']],
                'kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pengawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPengawaiTeknikal::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
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
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
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
                'no_passport' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'umur' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true, 'id'=>'umurId']],
                'jantina' =>[
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
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'alamat_e_mail' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tahap_akademik' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-tahap-akademik-pegawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTahapAkademikPegawaiTeknikal::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tahapAkademik],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tahap_akademik_lain_lain' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
    ]
]);
    ?>
    
    <?php // Upload
    if($model->tahap_kelayakan_sukan_peringkat_kebangsaan){
        echo "<label>" . $model->getAttributeLabel('tahap_kelayakan_sukan_peringkat_kebangsaan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->tahap_kelayakan_sukan_peringkat_kebangsaan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id, 'field'=> 'tahap_kelayakan_sukan_peringkat_kebangsaan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
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
                        'tahap_kelayakan_sukan_peringkat_kebangsaan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Upload
    if($model->tahap_kelayakan_sukan_peringkat_antarabangsa){
        echo "<br><label>" . $model->getAttributeLabel('tahap_kelayakan_sukan_peringkat_antarabangsa') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->tahap_kelayakan_sukan_peringkat_antarabangsa , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id, 'field'=> 'tahap_kelayakan_sukan_peringkat_antarabangsa'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
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
                        'tahap_kelayakan_sukan_peringkat_antarabangsa' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    <br>
    <pre style="text-align: center; background-color: #a5a5a5;"><strong><?php echo GeneralLabel::maklumat_majikan_cap; ?></strong></pre>
    
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
                'nama_majikan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'no_telefon_majikan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'no_faks' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jawatan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'gred' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
            ],
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center; background-color: #a5a5a5;"><strong><?php echo strtoupper(GeneralLabel::maklumat_kejohanan_kursus_cap); ?></strong></pre>
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
    
    <?php Pjax::begin(['id' => 'maklumatPegawaiTeknikalKejohananGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderMaklumatPegawaiTeknikalKejohanan,
        //'filterModel' => $searchModelMaklumatPegawaiTeknikalKejohanan,
        'id' => 'pembayaranInsentifAtletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_kejohanan_kursus',
            [
                'attribute' => 'tarikh_mula',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);
                },
            ],
            'tempat',
            [
                'attribute' => 'program',
                'value' => 'refProgramPengawaiTeknikal.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['maklumat-pegawai-teknikal-kejohanan/delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id]).'", "'.GeneralMessage::confirmDelete.'", "maklumatPegawaiTeknikalKejohananGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-pegawai-teknikal-kejohanan/update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::maklumat_kejohanan_kursus_cap.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-pegawai-teknikal-kejohanan/view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::maklumat_kejohanan_kursus_cap.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        $bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id = "";
        
        if(isset($model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id)){
            $bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id = $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-pegawai-teknikal-kejohanan/create', 'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => $bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::maklumat_kejohanan_kursus_cap.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
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
                'nama_kejohanan_kursus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'tarikh_mula' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>true]],
                'program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-pengawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramPengawaiTeknikal::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
    ]
]);*/
    ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$LELAKI_CODE = RefJantina::LELAKI;
$PEREMPUAN_CODE = RefJantina::PEREMPUAN;

$script = <<< JS
        
    $(document).ready(function(){
        if($("#noKadPengenalanId").val() != ""){
            getAgeFromICNo($("#noKadPengenalanId").val());
        }
    });
        
    $("#noKadPengenalanId").focusout(function(){
        getAgeFromICNo(this.value);
    });
        
    function getAgeFromICNo(ICNo){
        var DOBVal = "";

        if(ICNo != ""){
            DOBVal = getDOBFromICNo(ICNo);
        
            if(isEven(ICNo)){
                // if IC No is even then is woman
                $("#maklumatpegawaiteknikal-jantina").val('$PEREMPUAN_CODE').trigger("change");
            } else {
                // if IC No is odd then is guy
                $("#maklumatpegawaiteknikal-jantina").val('$LELAKI_CODE').trigger("change");
            }
        
            $("#umurId").val(calculateAge(formatSaveDate(DOBVal)));
        }
    }
 
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
    });
        
JS;
        
$this->registerJs($script);
?>