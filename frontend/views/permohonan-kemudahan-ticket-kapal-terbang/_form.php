<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;
use kartik\widgets\TimePicker;

// table reference
use app\models\Jurulatih;
use app\models\Atlet;
use app\models\RefProgram;
use app\models\RefSukan;
use app\models\RefBahagianKemudahan;
use app\models\RefCawanganKemudahan;
use app\models\RefStatusPermohonanKemudahan;
use app\models\RefBahagianAduan;
use app\models\RefCawangan;
use app\models\PerancanganProgram;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-kemudahan-ticket-kapal-terbang-form">
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly,]); ?>
    <?php //echo $form->errorSummary($model); ?>
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
                'nama_pemohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'bahagian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-aduan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBahagianAduan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                        'data'=>ArrayHelper::map(RefCawangan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::cawangan],
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
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        // 'data'=>ArrayHelper::map(PerancanganProgram::find()->all(),'perancangan_program_id', 'nama_program'),
                        // 'options' => ['placeholder' => Placeholder::program],
                        'data'=>ArrayHelper::map(\app\models\PerancanganProgramPlan::find()->joinWith('refKategoriPelan')
                            ->where(['LIKE', 'desc', 'kejohanan'])->all(),'perancangan_program_id', 'nama_program'),
                        'options' => ['placeholder' => Placeholder::kejohanan_temasya],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'no_fail_kelulusan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                'bil_penumpang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11,'disabled'=>true]],
            ]
        ],
        
    ]
]);
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
                'aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'kod_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                /*'sukan' => [
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
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],*/
            ]
        ],
        
    ]
]);
    ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::pergi?></strong>
        </div>
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
                            'pri_tarikh_pergi' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> DateControl::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                // 'pluginEvents' => [
                                    // "changeDate" => "function(e) {  alert('sadsad'); }",
                                // ],
                                // 'clientOptions' => [
                                    // 'onSelect' => "function(e) {  alert('sadsad'); }",
                                // ],
                                
                                'columnOptions'=>['colspan'=>3]],
                            'pri_flight_pergi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true],'columnOptions'=>['colspan'=>3]],
                            'pri_masa_pergi' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> TimePicker::classname(),
                                'ajaxConversion'=>false,
                                'data-type' => 'testabc',
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'pri_destinasi_pergi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                        ]
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::balik?></strong>
        </div>
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
                            'pri_tarikh_balik' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> DateControl::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'pri_flight_balik' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            'pri_masa_balik' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> TimePicker::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'pri_destinasi_balik' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                        ]
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
    
    
    <h3><?php echo GeneralLabel::sukan; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'permohonanKemudahanTicketKapalTerbangSukanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanKemudahanTicketKapalTerbangSukan,
        //'filterModel' => $searchModelPermohonanKemudahanTicketKapalTerbangSukan,
        'id' => 'permohonanKemudahanTicketKapalTerbangSukanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_kemudahan_ticket_kapal_terbang_sukan_id',
            //'permohonan_kemudahan_ticket_kapal_terbang_id',
            [
                'attribute' => 'sukan',
                'value' => 'refSukan.desc'
            ],
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-sukan/delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanKemudahanTicketKapalTerbangSukanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-sukan/update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-sukan/view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::sukan.'");',
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
        $permohonan_kemudahan_ticket_kapal_terbang_id = "";
        
        if(isset($model->permohonan_kemudahan_ticket_kapal_terbang_id)){
            $permohonan_kemudahan_ticket_kapal_terbang_id = $model->permohonan_kemudahan_ticket_kapal_terbang_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-sukan/create', 'permohonan_kemudahan_ticket_kapal_terbang_id' => $permohonan_kemudahan_ticket_kapal_terbang_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    
    <?php
        // selected sukan list
        /*$sukan_selected = null;
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
        }

         // Senarai Sukan
        echo '<label class="control-label">'.$model->getAttributeLabel('sukan').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'permohonankemudahanticketkapalterbang-sukan',
            'name' => 'PermohonanKemudahanTicketKapalTerbang[sukan]',
            'value' => $sukan_selected, // initial value
            'data' => ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
            'options' => ['placeholder' => Placeholder::sukan, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);*/
    ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::atlet; ?></h3>
    
    <?php Pjax::begin(['id' => 'permohonanKemudahanTicketKapalTerbangAtletGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet,
        //'filterModel' => $searchModelPermohonanKemudahanTicketKapalTerbangAtlet,
        'id' => 'permohonanKemudahanTicketKapalTerbangAtletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_kemudahan_ticket_kapal_terbang_atlet_id',
            //'permohonan_kemudahan_ticket_kapal_terbang_id',
            [
                'attribute' => 'atlet',
                'value' => 'refAtlet.name_penuh'
            ],
			'passport_no',
			'ic_no',
			'hp_no',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-atlet/delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanKemudahanTicketKapalTerbangAtletGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-atlet/update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::atlet.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-atlet/view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::atlet.'");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-atlet/create', 'permohonan_kemudahan_ticket_kapal_terbang_id' => $permohonan_kemudahan_ticket_kapal_terbang_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::atlet.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    
    <?php
        // selected atlet list
        /*$atlet_selected = null;
        if(isset($model->atlet) && $model->atlet != ''){
            $atlet_selected=explode(',',$model->atlet);
        }

         // Senarai Atlet
        echo '<label class="control-label">'.$model->getAttributeLabel('atlet').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'permohonankemudahanticketkapalterbang-atlet',
            'name' => 'PermohonanKemudahanTicketKapalTerbang[atlet]',
            'value' => $atlet_selected, // initial value
            'data' => ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
            'options' => ['placeholder' => Placeholder::atlet, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);*/
    ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::jurulatih; ?></h3>
    
    <?php Pjax::begin(['id' => 'permohonanKemudahanTicketKapalTerbangJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih,
        //'filterModel' => $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih,
        'id' => 'permohonanKemudahanTicketKapalTerbangJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_kemudahan_ticket_kapal_terbang_jurulatih_id',
            //'permohonan_kemudahan_ticket_kapal_terbang_id',
            [
                'attribute' => 'jurulatih',
                'value' => 'refJurulatih.nama'
            ],
			'passport_no',
			'ic_no',
			'hp_no',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-jurulatih/delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanKemudahanTicketKapalTerbangJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-jurulatih/update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jurulatih.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-jurulatih/view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jurulatih.'");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-jurulatih/create', 'permohonan_kemudahan_ticket_kapal_terbang_id' => $permohonan_kemudahan_ticket_kapal_terbang_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jurulatih.'");',
                        'class' => 'btn btn-success',
                        'id' => 'plus-jurulatih',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php
        // selected jurulatih list
        /*$jurulatih_selected = null;
        if(isset($model->jurulatih) && $model->jurulatih != ''){
            $jurulatih_selected=explode(',',$model->jurulatih);
        }

         // Senarai Jurulatih
        echo '<label class="control-label">'.$model->getAttributeLabel('jurulatih').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'permohonankemudahanticketkapalterbang-jurulatih',
            'name' => 'PermohonanKemudahanTicketKapalTerbang[jurulatih]',
            'value' => $jurulatih_selected, // initial value
            'data' => ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
            'options' => ['placeholder' => Placeholder::jurulatih, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);*/
    ?>
    
    <h3><?php echo GeneralLabel::pegawai; ?></h3>
    
    <?php Pjax::begin(['id' => 'permohonanKemudahanTicketKapalTerbangPegawaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai,
        //'filterModel' => $searchModelPermohonanKemudahanTicketKapalTerbangPegawai,
        'id' => 'permohonanKemudahanTicketKapalTerbangPegawaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_kemudahan_ticket_kapal_terbang_pegawai_id',
            //'permohonan_kemudahan_ticket_kapal_terbang_id',
            'pegawai',
			'passport_no',
			'ic_no',
			'hp_no',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pegawai/delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pegawai_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanKemudahanTicketKapalTerbangPegawaiGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pegawai/update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pegawai_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pegawai.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pegawai/view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pegawai_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pegawai.'");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pegawai/create', 'permohonan_kemudahan_ticket_kapal_terbang_id' => $permohonan_kemudahan_ticket_kapal_terbang_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pegawai.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::pengurus_sukan; ?></h3>
    
    <?php Pjax::begin(['id' => 'permohonanKemudahanTicketKapalTerbangPengurusSukanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan,
        'id' => 'permohonanKemudahanTicketKapalTerbangPengurusSukanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pengurus_sukan',
			'passport_no',
			'ic_no',
			'hp_no',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pengurus-sukan/delete', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pengurus_sukan_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanKemudahanTicketKapalTerbangPengurusSukanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pengurus-sukan/update', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pengurus_sukan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pengurus_sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pengurus-sukan/view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_pengurus_sukan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pengurus_sukan.'");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-kemudahan-ticket-kapal-terbang-pengurus-sukan/create', 'permohonan_kemudahan_ticket_kapal_terbang_id' => $permohonan_kemudahan_ticket_kapal_terbang_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pengurus_sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    
    <?php
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'atlet' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],*/
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jurulatih' => [
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
                        'options' => ['placeholder' => Placeholder::jurulatih],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],*/
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pegawai_teknikal' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100], 'hint'=>'Cth. masuk lebih dari satu pegawai: Mohd Ali, Camelian, Yusof'],
            ]
        ],
    ]
]);*/
    ?>
    
    <!--<br>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::pergi?></strong>
        </div>
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
                                'tarikh' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'destinasi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                                
                                'tarikh_ke' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pergi_2' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pergi_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                                
                                'ke_pergi_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pergi_3' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pergi_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                                
                                'ke_pergi_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::pulang?></strong>
        </div>
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
                                'pulang' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'pulang_tarikh_dari' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                                'pulang_tarikh_ke' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pulang_2' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pulang_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                                'ke_pulang_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pulang_3' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pulang_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                                'ke_pulang_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>-->
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['kelulusan']) || $readonly): ?>
    <hr>
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
                /*'kelulusan' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],*/
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanKemudahan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>50]],
                'tarikh_jkb' => [
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
                 'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
                 
            ],
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <!--<?= $form->field($model, 'nama_pemohon')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'bahagian')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jawatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'destinasi')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_fail_kelulusan')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bil_penumpang')->textInput() ?>

    <?= $form->field($model, 'aktiviti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kod_perbelanjaan')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sukan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'atlet')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jurulatih')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'pegawai_teknikal')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>-->

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
$URL_TIKET = Url::to(['/permohonan-kemudahan-ticket-kapal-terbang/set-primary']);

$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#permohonankemudahanticketkapalterbang-atlet').change(function(){
        calculateTotalPassager();
});
        
$('#permohonankemudahanticketkapalterbang-jurulatih').change(function(){
        calculateTotalPassager();
});
        
$('#permohonankemudahanticketkapalterbang-pegawai_teknikal').keypress(function(){
        calculateTotalPassager();
});
        
function calculateTotalPassager(){
    var valAtlet = String($("#permohonankemudahanticketkapalterbang-atlet").val());     
    var jumlahAtlet = valAtlet.split(",").length;
        
    var valJurulatih = String($("#permohonankemudahanticketkapalterbang-jurulatih").val());     
    var jumlahJurulatih = valJurulatih.split(",").length;
        
    var valPegawai = String($("#permohonankemudahanticketkapalterbang-pegawai_teknikal").val());     
    var jumlahPegawai = valPegawai.split(",").length;
        
        //alert(jumlahAtlet+ jumlahJurulatih + jumlahPegawai);
    $("#permohonankemudahanticketkapalterbang-bil_penumpang").val((jumlahAtlet+ jumlahJurulatih + jumlahPegawai));
}
            
$("#sama_alamat").change(function() {
    if(this.checked) {
        $("#atlet-alamat_surat_menyurat_1").val($("#atlet-alamat_rumah_1").val());
        $("#atlet-alamat_surat_menyurat_2").val($("#atlet-alamat_rumah_2").val());
        $("#atlet-alamat_surat_menyurat_3").val($("#atlet-alamat_rumah_3").val());
        $("#atlet-alamat_surat_negeri").val($("#atlet-alamat_rumah_negeri").val()).trigger("change");
        $("#atlet-alamat_surat_bandar").val($("#atlet-alamat_rumah_bandar").val()).trigger("change");
        $("#atlet-alamat_surat_poskod").val($("#atlet-alamat_rumah_poskod").val());
    }
});
            
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});



$("#permohonankemudahanticketkapalterbang-pri_tarikh_pergi").change(function() {
    setPrimary('pri_tarikh_pergi', $(this).val());
});

$("#permohonankemudahanticketkapalterbang-pri_flight_pergi").change(function() {
    setPrimary('pri_flight_pergi', $(this).val());
});

$("#permohonankemudahanticketkapalterbang-pri_masa_pergi").change(function() {
    setPrimary('pri_masa_pergi', $(this).val());
});

$("#permohonankemudahanticketkapalterbang-pri_destinasi_pergi").change(function() {
    setPrimary('pri_destinasi_pergi', $(this).val());
});
//balik
$("#permohonankemudahanticketkapalterbang-pri_tarikh_balik").change(function() {
    setPrimary('pri_tarikh_balik', $(this).val());
});

$("#permohonankemudahanticketkapalterbang-pri_flight_balik").change(function() {
    setPrimary('pri_flight_balik', $(this).val());
});

$("#permohonankemudahanticketkapalterbang-pri_masa_balik").change(function() {
    setPrimary('pri_masa_balik', $(this).val());
});

$("#permohonankemudahanticketkapalterbang-pri_destinasi_balik").change(function() {
    setPrimary('pri_destinasi_balik', $(this).val());
});

function setPrimary(type, value){
    $.post('$URL_TIKET',{'type':type, 'set': value},function(data){
        //alert(data);
    });
}

JS;
        
$this->registerJs($script);
?>
