<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\RefKategoriPencalonanLain;
use app\models\Atlet;
use app\models\Jurulatih;
use app\models\ProfilBadanSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanLain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-lain-form">

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
    if($model->gambar){
        echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        if(!$readonly){
            echo Html::a(GeneralLabel::removeImage, ['deleteupload', 'id'=>$model->anugerah_pencalonan_lain_id, 'field'=> 'gambar'], 
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
                        'gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['accept' => 'image/*'], 'pluginOptions' => ['previewFileType' => 'image'], 'hint'=>GeneralLabel::getFileUploadMaxSizeHint()],
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
               
                 'kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pencalonan-lain/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPencalonanLain::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
    ]
]);
        ?>
    
    <div id="atletDiv">
        <div class="row">
            <div class="col-sm-9">
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
               
                 'atlet' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(GeneralFunction::getAtlet(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
    ]
]);
        ?>
                </div>
                <div class="col-sm-3">
                    <fieldset>
                        <div class="form-group">
                        <label class="control-label" > &nbsp;</label>
                        <div id="atletLink"></div>
                        <div class="help-block"></div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    
    <div id="jurulatihDiv">
        <div class="row">
            <div class="col-sm-9">
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
               
                 'jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(GeneralFunction::getJurulatih(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
    ]
]);
        ?>
            </div>
                <div class="col-sm-3">
                    <fieldset>
                        <div class="form-group">
                        <label class="control-label" > &nbsp;</label>
                        <div id="jurulatihLink"></div>
                        <div class="help-block"></div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    
    <div id="persatuanDiv">
        <div class="row">
            <div class="col-sm-9">
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
               
                 'persatuan_sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/profil-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(GeneralFunction::getProfilBadanSukan(),'profil_badan_sukan', 'nama_badan_sukan'),
                        'options' => ['placeholder' => Placeholder::persatuan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
    ]
]);
        ?>
            </div>
                <div class="col-sm-3">
                    <fieldset>
                        <div class="form-group">
                        <label class="control-label" > &nbsp;</label>
                        <div id="persatuanLink"></div>
                        <div class="help-block"></div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    
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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_tel_1' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_tel_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
            ],
        ],
    ]
]);
        ?>
    
    <h3><?php echo GeneralLabel::jawatan_yang_sedang_pernah_disandang_dalam_persatuan_pertubuhan_sukan; ?></h3>
    
    
    
    <?php Pjax::begin(['id' => 'anugerahPencalonanLainJawatanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAnugerahPencalonanLainJawatan,
        //'filterModel' => $searchModelAnugerahPencalonanLainJawatan,
        'id' => 'anugerahPencalonanLainJawatanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'anugerah_pencalonan_lain_jawatan_id',
            //'anugerah_pencalonan_lain_id',
            'jawatan',
            'nama_persatuan_pertubuhan',
            'tempoh',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['anugerah-pencalonan-lain-jawatan/delete', 'id' => $model->anugerah_pencalonan_lain_jawatan_id]).'", "'.GeneralMessage::confirmDelete.'", "anugerahPencalonanLainJawatanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-pencalonan-lain-jawatan/update', 'id' => $model->anugerah_pencalonan_lain_jawatan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jawatan_yang_sedang_pernah_disandang_dalam_persatuan_pertubuhan_sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-pencalonan-lain-jawatan/view', 'id' => $model->anugerah_pencalonan_lain_jawatan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jawatan_yang_sedang_pernah_disandang_dalam_persatuan_pertubuhan_sukan.'");',
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
        $anugerah_pencalonan_lain_id = "";
        
        if(isset($model->anugerah_pencalonan_lain_id)){
            $anugerah_pencalonan_lain_id = $model->anugerah_pencalonan_lain_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-pencalonan-lain-jawatan/create', 'anugerah_pencalonan_lain_id' => $anugerah_pencalonan_lain_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jawatan_yang_sedang_pernah_disandang_dalam_persatuan_pertubuhan_sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    
    
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
                'sumbangan_dalam_pencapaian' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'ulasan_justifikasi' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>

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
$KATEGORI_ATLET = RefKategoriPencalonanLain::ATLET;
$KATEGORI_JURULATIH = RefKategoriPencalonanLain::JURULATIH;
$KATEGORI_PERSATUAN_SUKAN = RefKategoriPencalonanLain::PERSATUAN_SUKAN;

$DateDisplayFormat = GeneralVariable::displayDateFormat;

$URLAtlet = Url::to(['/atlet/get-atlet']);
$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);
$URLPersatuan = Url::to(['/profil-badan-sukan/get-badan-sukan']);

$script = <<< JS
        
$(document).ready(function(){
    checkKategori();
});
        
$('#anugerahpencalonanlain-kategori').change(function(){
    checkKategori();
        clearForm();
});
        
function checkKategori(){
    $('#atletDiv').hide();
    $('#jurulatihDiv').hide();
    $('#persatuanDiv').hide();
        
    if($('#anugerahpencalonanlain-kategori').val() == '$KATEGORI_ATLET'){
        $('#atletDiv').show();
    } else if($('#anugerahpencalonanlain-kategori').val() == '$KATEGORI_JURULATIH'){
        $('#jurulatihDiv').show();
    } else if($('#anugerahpencalonanlain-kategori').val() == '$KATEGORI_PERSATUAN_SUKAN'){
        $('#persatuanDiv').show();
    }
}
        
$('#anugerahpencalonanlain-atlet').change(function(){
            
    if($(this).val() != ''){
        $.get('$URLAtlet',{id:$(this).val()},function(data){
            clearForm();
            
            var data = $.parseJSON(data);

            if(data !== null){
                $('#anugerahpencalonanlain-nama').attr('value',data.name_penuh);
                $('#anugerahpencalonanlain-no_kad_pengenalan').attr('value',data.ic_no);
                $("#anugerahpencalonanlain-no_tel_1").attr('value',data.tel_no);
                $("#anugerahpencalonanlain-no_tel_2").attr('value',data.tel_bimbit_no_1);
            
                $("#atletLink").html(data.view_url_button);
            }
        });
    }
});
        
$('#anugerahpencalonanlain-jurulatih').change(function(){
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#anugerahpencalonanlain-nama').attr('value',data.nama);
            $('#anugerahpencalonanlain-no_kad_pengenalan').attr('value',data.ic_no);
            $('#anugerahpencalonanlain-no_tel_1').attr('value',data.no_telefon);
            $('#anugerahpencalonanlain-no_tel_2').attr('value',data.no_telefon_bimbit);
        
            $("#jurulatihLink").html(data.view_url_button);
        }
        
        });
});
        
$('#anugerahpencalonanlain-persatuan_sukan').change(function(){
            
    if($(this).val() != ''){
        $.get('$URLPersatuan',{id:$(this).val()},function(data){
            clearForm();
            
            var data = $.parseJSON(data);

            if(data !== null){
                //$('#anugerahpencalonanlain-nama').attr('value',data.name_penuh);
                //$('#anugerahpencalonanlain-no_kad_pengenalan').attr('value',data.ic_no);
                $("#anugerahpencalonanlain-no_tel_1").attr('value',data.no_telefon_pejabat);
                $("#anugerahpencalonanlain-no_tel_2").attr('value',data.no_tel_bimbit);
            }
        });
    }
});
         
function clearForm(){
    $('#anugerahpencalonanlain-nama').attr('value','');
    $('#anugerahpencalonanlain-no_kad_pengenalan').attr('value','');
    $("#anugerahpencalonanlain-no_tel_1").attr('value','');
    $("#anugerahpencalonanlain-no_tel_2").attr('value','');
        
        $("#atletLink").html('');
        $("#jurulatihLink").html('');
        $("#persatuanLink").html('');
}
        
JS;
        
$this->registerJs($script);
?>
