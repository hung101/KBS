<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\RefNegeri;
use app\models\RefPeringkatBadanSukan;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\ProfilBadanSukan;
use app\models\PengurusanJawatankuasaKhasSukanMalaysia;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilDelegasiTeknikal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-delegasi-teknikal-form">
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_temasya_cap; ?></strong></pre>
    
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
                'temasya' => [
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
                        'data'=>ArrayHelper::map(PengurusanJawatankuasaKhasSukanMalaysia::find()->all(),'pengurusan_jawatankuasa_khas_sukan_malaysia_id', 'temasya'),
                        'options' => ['placeholder' => Placeholder::temasya, 'id'=>'pengurusanJawatankuasaId'],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>3]],
                'negeri' => [
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
                        'options' => ['placeholder' => Placeholder::negeri, 'disabled'=>true],
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
                'tarikh_mula' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
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
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_persatuan_cap; ?></strong></pre>
    
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
                'nama_badan_sukan' => [
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
                        'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                        'options' => ['placeholder' => Placeholder::badanSukan, 'id'=>'badanSukanId'],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>3]],
                'peringkat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatBadanSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkatBadanSukan],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],
                    ],
                    'columnOptions'=>['colspan'=>4]],
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            //'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
    ]
]);
    ?>
    
     <h3><?php echo GeneralLabel::ahli; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'ahliGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProfilDelegasiTeknikalAhli,
        //'filterModel' => $searchModelProfilDelegasiTeknikalAhli,
        'id' => 'ahliGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profil_delegasi_teknikal_ahli_id',
            //'profil_delegasi_teknikal_id',
            //'nama',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            //'no_kad_pengenalan',
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ]
            ],
            //'jantina',
            [
                'attribute' => 'jantina',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jantina,
                ],
                'value' => 'refJantina.desc'
            ],
            // 'tarikh_lahir',
            // 'umur',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            //'jawatan',
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ],
                'value' => 'refJawatanDelegasiTeknikal.desc'
            ],
            // 'no_telefon_bimbit',
            // 'emel',
            // 'pekerjaan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',
            // 'no_telefon_pejabat',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['profil-delegasi-teknikal-ahli/delete', 'id' => $model->profil_delegasi_teknikal_ahli_id]).'", "'.GeneralMessage::confirmDelete.'", "ahliGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['profil-delegasi-teknikal-ahli/update', 'id' => $model->profil_delegasi_teknikal_ahli_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::ahli.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['profil-delegasi-teknikal-ahli/view', 'id' => $model->profil_delegasi_teknikal_ahli_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::ahli.'");',
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
        $profil_delegasi_teknikal_id = "";
        
        if(isset($model->profil_delegasi_teknikal_id)){
            $profil_delegasi_teknikal_id = $model->profil_delegasi_teknikal_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['profil-delegasi-teknikal-ahli/create', 'profil_delegasi_teknikal_id' => $profil_delegasi_teknikal_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::ahli.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLBadanSukan = Url::to(['/profil-badan-sukan/get-badan-sukan']);
$URLPengurusanJawatankuasaKhasSukanMalaysia = Url::to(['/pengurusan-jawatankuasa-khas-sukan-malaysia/get-pengurusan-jawatankuasa-khas-sukan-malaysia']);

$script = <<< JS
        
$('#badanSukanId').change(function(){
    
    $.get('$URLBadanSukan',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $("#profildelegasiteknikal-peringkat").val(data.peringkat_badan_sukan).trigger("change");
            $('#profildelegasiteknikal-alamat_1').attr('value',data.alamat_tetap_badan_sukan_1);
            $('#profildelegasiteknikal-alamat_2').attr('value',data.alamat_tetap_badan_sukan_2);
            $('#profildelegasiteknikal-alamat_3').attr('value',data.alamat_tetap_badan_sukan_3);
            $("#profildelegasiteknikal-alamat_negeri").val(data.alamat_tetap_badan_sukan_negeri).trigger("change");
            $("#profildelegasiteknikal-alamat_bandar").val(data.alamat_tetap_badan_sukan_bandar).trigger("change");
            $('#profildelegasiteknikal-alamat_poskod').attr('value',data.alamat_tetap_badan_sukan_poskod);
            
        }
    });
});
     
function clearForm(){
    $("#profildelegasiteknikal-peringkat").val('').trigger("change");
    $('#profildelegasiteknikal-alamat_1').attr('value','');
    $('#profildelegasiteknikal-alamat_2').attr('value','');
    $('#profildelegasiteknikal-alamat_3').attr('value','');
    $("#profildelegasiteknikal-alamat_negeri").val('').trigger("change");
    $("#profildelegasiteknikal-alamat_bandar").val('').trigger("change");
    $('#profildelegasiteknikal-alamat_poskod').attr('value','');
}
        
$('#pengurusanJawatankuasaId').change(function(){
    
    $.get('$URLPengurusanJawatankuasaKhasSukanMalaysia',{id:$(this).val()},function(data){
        clearFormTemasya();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#profildelegasiteknikal-tarikh_mula').attr('value',data.tarikh_mula);
            $("#profildelegasiteknikal-tarikh_mula-disp").val(data.tarikh_mula);
            $('#profildelegasiteknikal-tarikh_tamat').attr('value',data.tarikh_tamat);
            $("#profildelegasiteknikal-tarikh_tamat-disp").val(data.tarikh_tamat);
            $("#profildelegasiteknikal-negeri").val(data.negeri).trigger("change");
            //$("#profildelegasiteknikal-sukan").val(data.sukan).trigger("change");
            
        }
    });
});
        
function clearFormTemasya(){
    $('#profildelegasiteknikal-tarikh_mula').attr('value','');
    $("#profildelegasiteknikal-tarikh_mula-disp").val('');
    $('#profildelegasiteknikal-tarikh_tamat').attr('value','');
    $("#profildelegasiteknikal-tarikh_tamat-disp").val('');
    $("#profildelegasiteknikal-negeri").val('').trigger("change");
    //$("#profildelegasiteknikal-sukan").val('').trigger("change");
}
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#profildelegasiteknikal-negeri").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>
