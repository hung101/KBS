<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\grid\GridView;

// table reference
use app\models\RefJantina;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefNegara;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefBahagianJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefSubProgramPelapisJurulatih;
use app\models\RefLainProgramJurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefStatusPermohonanJurulatih;
use app\models\RefKeaktifanJurulatih;
use app\models\RefSektorPekerjaan;
use app\models\RefAgensiJurulatih;
use app\models\RefStatusTawaran;
use app\models\RefTawaran;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\Jurulatih */
/* @var $form yii\widgets\ActiveForm */

// $subStatus = RefStatusJurulatih::find()->select('id')->where(['LIKE', 'desc', '%JPM%']);
// $checkStatus = Jurulatih::find()->where(['jurulatih_id' => $mode])->one();
// var_dump($model->status_jurulatih); die;
$isTerima = false;
$mpjLulus = false;
$jkbLulus = false;

// $query = RefStatusTawaran::find()->where(['id' => $model->status_tawaran_mpj])->andWhere(['LIKE', 'desc', '%lulus%'])->one();
// if(count($query) > 0) $mpjLulus = true;
// $query = RefStatusTawaran::find()->where(['id' => $model->status_tawaran_jkb])->andWhere(['LIKE', 'desc', '%lulus%'])->one();
// if(count($query) > 0) $jkbLulus = true;
$substrMpj = stripos($model->status_tawaran_mpj, 'lulus');
if(is_bool($substrMpj) === false) $mpjLulus = true;

$substrJkb = stripos($model->status_tawaran_jkb, 'lulus');
if(is_bool($substrJkb) === false)  $jkbLulus = true;

if($mpjLulus && $jkbLulus) $isTerima = true;
//var_dump($isTerima); die;

if ($readonly) {
    $ref = RefTawaran::findOne(['id' => $model->tawaran_jurulatih]);
    $model->tawaran_jurulatih = $ref['desc'];
}
?>

<div class="jurulatih-form">
    <h1><?php echo GeneralLabel::peribadi ?></h1>
    
    <?php if($readonly): ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update']) && $model->approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->jurulatih_id, 'mesyuarat_id' => $mesyuarat_id,], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if($mesyuarat_id == null): ?>
            <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])): ?>
                <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->jurulatih_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => GeneralMessage::confirmDelete,
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
            <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['create']) && $model->approved == 0)): ?>
                <?= Html::a(GeneralLabel::send, ['approved', 'id' => $model->jurulatih_id], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
            <?php //echo Html::button(GeneralLabel::print_pdf, [ 'class' => 'btn btn-info', 'onclick' => 'window.print();' ]); ?>
            <?php echo Html::a(GeneralLabel::print_pdf, '', ['value'=>Url::to(['/jurulatih/print', 'id' => $model->jurulatih_id]), 'class' => 'btn btn-info custom_button']); ?>
            <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update']) && $isTerima && isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
                <?php echo Html::a(GeneralLabel::surat_tawaran, ['surat-tawaran-jurulatih', 'id' => $model->jurulatih_id], ['class' => 'btn btn-warning', 'target' => '_blank']); 
                ?>
                <?php echo Html::a(GeneralLabel::surat_setuju_terima.' ('.GeneralLabel::sambungan.')', ['jurulatih-sambungan-oversea', 'id' => $model->jurulatih_id], ['class' => 'btn btn-warning', 'target' => '_blank']); 
                ?>
                <?php echo Html::a(GeneralLabel::surat_setuju_terima.' ('.GeneralLabel::lantikan_baru.')', ['jurulatih-baru-oversea', 'id' => $model->jurulatih_id], ['class' => 'btn btn-warning', 'target' => '_blank']); 
                ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <br>
    
    <?php
        $negeri_list = RefNegeri::find()->where(['=', 'aktif', 1])->all();
        
        // add filter base on sukan access role in tbl_user->negeri - START
        if(Yii::$app->user->identity->negeri){
            $negeri_access=explode(',',Yii::$app->user->identity->negeri);
            
            $arr_negeri_filter = array();
            
            for($i = 0; $i < count($negeri_access); $i++){
                $arr_negeri = null;
                $arr_negeri = array('id'=>$negeri_access[$i]); 
                    array_push($arr_negeri_filter,$arr_negeri);
            }
            
            $negeri_list = RefNegeri::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_negeri_filter])->all();
        }
        // add filter base on sukan access role in tbl_user->negeri - END
        
    ?>
    

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>$model->formName()]); ?>
    <?php //echo $form->errorSummary($model); ?>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_peribadi ?></strong></pre>
    
    <?php // Gambar Upload
    
    $label = $model->getAttributeLabel('gambar');
    
    if($model->gambar){
        //echo "<div class='required'>";
        //echo "<label>" . $model->getAttributeLabel('gambar') . "</label><br>";
        //echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        //echo '<br><br>';
        //echo "</div>";
        
        //$label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label,'options'=>['accept' => 'image/*'], 'pluginOptions' => ['previewFileType' => 'image'],'hint'=>''],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
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
                'no_fail' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'ic_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12, 'id'=>'NoICID']],
                
                
            ],
        ],
        
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula_lantikan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat_lantikan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'passport_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>15]],
                'tamat_tempoh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_visa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'tamat_visa_tempoh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_permit_kerja' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'tamat_permit_tempoh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pusat_latihan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
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
                        'data'=>ArrayHelper::map(RefBangsa::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bangsa],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'agama' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agama/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgama::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agama],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
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
                        'data'=>ArrayHelper::map(RefJantina::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'warganegara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negara],
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
                'umur_jurulatih' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true, 'disabled'=>true, 'id'=>'UmurID']],
                'tempat_lahir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90],'hint'=>'cth: Tapah, Perak @ Bandung, Indonesia'],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'taraf_perkahwinan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-taraf-perkahwinan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTarafPerkahwinan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tarafPerkahwinan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'bil_tanggungan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],
        [
            'attributes' => [
                'alamat_rumah_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_rumah_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_rumah_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_rumah_negeri' => [
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
                        'data'=>ArrayHelper::map($negeri_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_rumah_bandar' => [
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
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_rumah_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_rumah_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
    ]
]);
    ?>
    
    <?php if(!$readonly):?>
    <input type="checkbox" id="sama_alamat"> <strong> <?=GeneralLabel::alamat_surat_sama_dengan_alamat_rumah?></strong> <br>
    <?php endif;?>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_surat_menyurat_negeri' => [
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
                        'data'=>ArrayHelper::map($negeri_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_bandar' => [
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
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
       [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
                //'status' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Status --'],'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'agensi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agensi-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgensiJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agensi],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                /*'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],],
                    'columnOptions'=>['colspan'=>3]],*/
                'status_keaktifan_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-keaktifan-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKeaktifanJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::keaktifanJurulatih],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                //'ic_no_lama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>8]],
                //'ic_tentera' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>12]],
                //'passport_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>15]],
                'status_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusJurulatih],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        
    ]
]);
    ?>
    
    <br>
    <!--<pre style="text-align: center"><strong>MAKLUMAT SUKAN</strong></pre>-->
    
    <?php
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_sukan' => [
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
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],*/
                /*'nama_acara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'nama_sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],*/
                /*'bahagian' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBahagianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bahagian],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-cawangan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefCawangan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::cawangan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
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
                'lain_lain_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-lain-program-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefLainProgramJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::lainLainProgram],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        
    ]
]);*/
    ?>
    
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_majikan_jurulatih; ?></strong></pre>
    
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
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'sektor' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sektor-pekerjaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSektorPekerjaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sektor],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
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
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                //'nama_majikan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ]
        ],        
    ]
]);
        
        $label = $model->getAttributeLabel('keputusan_mesyuarat');
        echo "<div class='required'>";
        if($model->keputusan_mesyuarat){
            echo "<div><label>" . $model->getAttributeLabel('keputusan_mesyuarat') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->keputusan_mesyuarat , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            echo "</div>";
            
            $label = false;
        }
        
        if(!$readonly){
            
            echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'keputusan_mesyuarat' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>4], 'label' => $label],
                            ],
                        ],
                    ]
                ]);
            
        }
        echo "</div>";
        echo '<br />';
        
        $label = $model->getAttributeLabel('surat_sokongan');
        echo "<div class='required'>";
        if($model->surat_sokongan){
            echo "<div><label>" . $model->getAttributeLabel('surat_sokongan') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_sokongan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            echo "</div>";
            
            $label = false;
        }
        
        if(!$readonly){
            
            echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'surat_sokongan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>4], 'label' => $label],
                            ],
                        ],
                    ]
                ]);
            
        }
        echo "</div>";
        echo '<br />';
        
        echo "<div class='required'>";
        $label = $model->getAttributeLabel('salinan_ic_passport');
        if($model->salinan_ic_passport){
            
            echo "<div><label>" . $model->getAttributeLabel('salinan_ic_passport') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_ic_passport , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            echo "</div>";
            
            $label = false;
        }
        
        if(!$readonly){
            
            echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'salinan_ic_passport' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>4], 'label' => $label],
                            ],
                        ],
                    ]
                ]);
            
        }
        echo "</div>";
        echo '<br />';  
    ?>
    
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['tawaran']) || $readonly):
        
        
        
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
/*                 [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'status_tawaran' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-status-tawaran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::status],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                    ]
                ], */
/*                 [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'status_tawaran_mpj' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-status-tawaran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::status],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],
                        'tarikh_mpj' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>4]],
                        'bilangan_mpj' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ]
                ], */
/*                 [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'pengerusi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                        //'kelulusan_dkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                    ]
                ], */
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan_spkk' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                        'bersyarat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'lain_lain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                        'tawaran_jurulatih' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-tawaran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefTawaran::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::status],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>6]],
                        //'catatan' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['rows'=>2],'columnOptions'=>['colspan'=>12]],
                    ]
                ],
            ]
        ]);
    
    ?>
    
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::kelulusan_mpj ?></strong></pre>
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
                        'status_tawaran_mpj' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-status-tawaran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::status],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],
                        'tarikh_mpj' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>4]],
                        'bilangan_mpj' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'pengerusi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan_mpj' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['rows'=>2],'columnOptions'=>['colspan'=>12]],
                    ]
                ],
            ]
        ]);
        
    ?>
    
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::kelulusan_jkb ?></strong></pre>
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
                        'status_tawaran_jkb' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-status-tawaran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::status],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],
                        'tarikh_jkb' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>4]],
                        'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'kelulusan_dkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['rows'=>2],'columnOptions'=>['colspan'=>12]],
                    ]
                ],
            ]
        ]);
        
        
        endif; // kelulusan tawaran
    ?>
    
    
    
    <?php 
    if(!$model->isNewRecord){
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
    <?php Pjax::begin(['id' => 'jurulatihBorangGrid', 'timeout' => 100000]); ?>

    <?php 
    if($model->borang_maklumat != null || $model->borang_maklumat != ''){
        
        $label = $model->getAttributeLabel('borang_maklumat');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_maklumat') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_maklumat , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php 
    if($model->borang_kesihatan != null || $model->borang_kesihatan != ''){
        
        $label = $model->getAttributeLabel('borang_kesihatan');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_kesihatan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_kesihatan , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php 
    if($model->borang_hrmis != null || $model->borang_hrmis != ''){
        
        $label = $model->getAttributeLabel('borang_hrmis');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_hrmis') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_hrmis , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php 
    if($model->borang_rawatan != null || $model->borang_rawatan != ''){
        
        $label = $model->getAttributeLabel('borang_rawatan');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_rawatan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_rawatan , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php 
    if($model->borang_keselamatan != null || $model->borang_keselamatan != ''){
        
        $label = $model->getAttributeLabel('borang_keselamatan');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_keselamatan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_keselamatan , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php 
    if($model->borang_pelekat != null || $model->borang_pelekat != ''){
        
        $label = $model->getAttributeLabel('borang_pelekat');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_pelekat') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_pelekat , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php 
    if($model->borang_income_tax != null || $model->borang_income_tax != ''){
        
        $label = $model->getAttributeLabel('borang_income_tax');
        
        echo "<div><label>" . $model->getAttributeLabel('borang_income_tax') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_income_tax , ['class'=>'btn btn-link', 'target'=>'_blank', 'data-pjax' => '0']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
    }
    ?>
    <?php Pjax::end(); ?>
    
    <?php
    }
    ?>
    <br />
    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
        <?php
        if(!$model->isNewRecord && !$readonly)
        echo Html::a(GeneralLabel::borang_kontrak, 'javascript:void(0);', [
                'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-borang-kontrak/create', 'id' => $model->jurulatih_id]).'", "'.GeneralLabel::upload . '");',
                'class' => 'btn btn-warning',
            ]);
        ?>
    </div>
    <div id="borangKontrakMsg" style="display:none">
        <div class="alert alert-success" role="alert"> <strong>Fail berjaya di muat naik</strong></div>
    </div>
    <br>
    
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong><?php echo GeneralLabel::senarai_document; ?></strong>
        </div>
        <ol>
            <li ><?php echo GeneralLabel::senarai_document_1; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_2; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_3; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_4; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_5; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_6; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_7; ?></li>
            <li ><?php echo GeneralLabel::senarai_document_8; ?></li>
          </ol>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLUploadBorang = Url::to(['jurulatih/upload-borang', 'id' => $model->jurulatih_id]);

$DateDisplayFormat = GeneralVariable::displayDateFormat;
$ConfirmMsg = GeneralMessage::confirmPrint;

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
     
$(document).ready(function(){
    if($("#TarikhLahirID").val() != ""){
        $("#UmurID").val(calculateAge($("#TarikhLahirID").val()));
    }
});
        
$("#NoICID").focusout(function(){
    var DOBVal = "";
    
    if(this.value != ""){
        DOBVal = getDOBFromICNo(this.value);
    }
    
        
    $("#TarikhLahirID-disp").val(formatSaveDate(DOBVal));
    $("#TarikhLahirID").val(formatSaveDate(DOBVal));
        
       /* $('#TarikhLahirID').kvDatepicker({
                format: 'mm/dd/yyyy',
                startDate: '-3d'
            });*/
        
    $("#UmurID").val(calculateAge(formatSaveDate(DOBVal)));
        
        
    $("#TarikhLahirID").kvDatepicker("$DateDisplayFormat", new Date(DOBVal)).kvDatepicker({
        format: "$DateDisplayFormat"
    });
});
        
$('#TarikhLahirID').change(function(){
    $("#UmurID").val(calculateAge(this.value));
});
            
$("#sama_alamat").change(function() {
    if(this.checked) {
        $("#jurulatih-alamat_surat_menyurat_1").val($("#jurulatih-alamat_rumah_1").val());
        $("#jurulatih-alamat_surat_menyurat_2").val($("#jurulatih-alamat_rumah_2").val());
        $("#jurulatih-alamat_surat_menyurat_3").val($("#jurulatih-alamat_rumah_3").val());
        $("#jurulatih-alamat_surat_menyurat_negeri").val($("#jurulatih-alamat_rumah_negeri").val()).trigger("change");
        $("#jurulatih-alamat_surat_menyurat_bandar").val($("#jurulatih-alamat_rumah_bandar").val()).trigger("change");
        $("#jurulatih-alamat_surat_menyurat_poskod").val($("#jurulatih-alamat_rumah_poskod").val());
    }
});
            
$(function(){
    $('.custom_button').click(function(){
        if(confirm("$ConfirmMsg")){
            window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        }
            
        return false;
    });

    $('#uploadBorang').click(function(e){
        e.preventDefault();
        window.open("$URLUploadBorang", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=100,left=300,width=500,height=700");
    });

});

JS;
        
$this->registerJs($script);
?>
