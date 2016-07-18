<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\grid\GridView;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefKategoriProgram;
use app\models\RefNegeri;
use app\models\RefSukan;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\RefStatusPermohonanSue;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$jumlahBE=0.0;
$jumlahPPB=0.0;
?>

<div class="user-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly,'options'=>['autocomplete'=>'off']]); ?>
    
    <?php
        echo $form->field($model, 'peranan')->hiddenInput()->label(false);
    ?>
    
    
    <?php 
    if(!isset($model->oldAttributes['username']) || $model->oldAttributes['username'] != "admin"){
        echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'username' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>30]],  
                        ],
                    ],
                ]
            ]);
    }
    
    if(!$readonly){
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'columnSize' => Form::SIZE_TINY,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'new_password' => ['type'=>Form::INPUT_PASSWORD,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>50]],
                        'password_confirm' => ['type'=>Form::INPUT_PASSWORD,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>50]],
                    ]
                ],
            ]
        ]);
    }
        
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'profil_badan_sukan' => [
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
                        'options' => ['placeholder' => Placeholder::persatuan, 'id'=>'badanSukanId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tel_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'email' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'expiry_date' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options' => ['id'=>'ExpiryDateID'],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'status' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusUser::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
        
        // selected sukan list
        $sukan_selected = null;
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
        }
        
        // Senarai Atlet Yang Memenangi
        echo '<label class="control-label">'.$model->getAttributeLabel('sukan').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'persatuan-sukan',
            'name' => 'Persatuan[sukan]',
            'value' => $sukan_selected, // initial value
            'data' => ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
            'options' => ['placeholder' => Placeholder::sukan, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);
        ?>
    
    <br>
    <br>

    <?php if(isset($dataProviderBE)): ?>
    <!-- Bantuan Elaun - START -->
    <div class="panel panel-default copyright-wrap" id="bantuan_elaun-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#bantuan_elaun-body">Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK Rekod</a>
            <button type="button" class="close" data-target="#bantuan_elaun-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="bantuan_elaun-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderBE,
            //'filterModel' => $searchModelBE,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            //'muatnaik_gambar',
            /*[
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ]
            ],
            [
                'attribute' => 'tarikh_lahir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_lahir,
                ]
            ],*/
            [
                'attribute' => 'jenis_bantuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_bantuan,
                ],
                'value' => 'refJenisBantuanSue.desc'
            ],
            [
                'attribute' => 'nama_persatuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_persatuan,
                ],
                'value' => 'refProfilBadanSukan.nama_badan_sukan'
            ],
            [
                'attribute' => 'jumlah_elaun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_elaun,
                ],
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanSue.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/bantuan-elaun/view', 'id' => $model->bantuan_elaun_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
                
            <?php 
                $jumlahBE = 0.00;
                foreach($dataProviderBE->models as $BEmodel){
                    if($BEmodel->status_permohonan == RefStatusPermohonanSue::LULUS){
                        $jumlahBE += $BEmodel->jumlah_elaun;
                    }
                }
            ?>
            <?php 
                echo "<label>Jumlah Dilulus: </label> RM" . $jumlahBE;
            ?>
            </div>
        </div>
    </div>
    
    <!-- Bantuan Elaun - END -->
    <?php endif; ?>
    
    <?php if(isset($dataProviderPPB)): ?>
    <!-- Program Binaan - START -->
    <div class="panel panel-default copyright-wrap" id="program_binaan-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#program_binaan-body">Program Binaan Rekod</a>
            <button type="button" class="close" data-target="#program_binaan-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="program_binaan-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPPB,
            //'filterModel' => $searchModelPPB,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktiviti,
                ],
                'value' => 'refPerancanganProgram.nama_program'
            ],
            [
                'attribute' => 'nama_aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_aktiviti,
                ]
            ],
             [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ]
            ],
             [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ]
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanProgramBinaan.desc'
            ],
            [
                'attribute' => 'jumlah_yang_diluluskan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_yang_diluluskan,
                ],
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/pengurusan-program-binaan/view', 'id' => $model->pengurusan_program_binaan_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
                
            <?php 
                $jumlahPPB = 0.00;
                foreach($dataProviderPPB->models as $PPBmodel){
                    if($PPBmodel->status_permohonan == RefStatusPermohonanProgramBinaan::LULUS){
                        $jumlahPPB += $PPBmodel->jumlah_yang_diluluskan;
                    }
                }
            ?>
            <?php 
                echo "<label>Jumlah Dilulus: </label> RM" . $jumlahPPB;
            ?>
            </div>
        </div>
    </div>
    <!-- Program Binaan - END -->
    <?php endif; ?>
    
    <?php 
    if(isset($dataProviderPPB) || isset($dataProviderBE)){
        echo "<label>Jumlah Dilulus Keseluruhan: </label> RM" . ($jumlahPPB + $jumlahBE);
    }
    ?>
    
    <br>
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URL = Url::to(['/profil-badan-sukan/get-badan-sukan']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});
        
$('#badanSukanId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            var tarikhLulus = data.tarikh_lulus_pendaftaran;
            var tarikhLulusAdd = new Date(tarikhLulus);
            tarikhLulusAdd.setFullYear(tarikhLulusAdd.getFullYear() + 1); // plus 1 year
        
            $("#ExpiryDateID-disp").val(formatDisplayDate(tarikhLulusAdd));
            $("#ExpiryDateID").val(formatSaveDate(tarikhLulusAdd));
        $('#persatuan-email').attr('value',data.emel_badan_sukan);
        }
    });
});
     
function clearForm(){
    $("#ExpiryDateID-disp").val('');
    $("#ExpiryDateID").val('');
        $('#persatuan-email').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
