<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use kartik\datecontrol\DateControl;
use yii\web\Session;

// table reference
use app\models\RefSukan;
use app\models\RefCawangan;
use app\models\RefGajiElaunJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefBahagianJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSukan */
/* @var $form yii\widgets\ActiveForm */

// Session
    $session = new Session;
    $session->open();
?>

<div class="jurulatih-sukan-form">
    
    <?php
        if(!$readonly){
            $template = '{view}';
        
            // Update Access
            if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])){
                $template .= ' {update}';
            }

            // Delete Access
            if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])){
                $template .= ' {delete}';
            }
        } else {
            $template = '{view}';
        }
    ?>
    
    <?php
        $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->all();
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>GeneralVariable::formJurulatihSukanID]); ?>

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
                        'data'=>ArrayHelper::map($sukan_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan, 'id'=>'sukanId'],
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
                'bahagian' => [
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
            ]
        ],
        
        [
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
        ],
        [
            'columns'=>3,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'gaji_elaun' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-gaji-elaun-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefGajiElaunJurulatih::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::gajiElaun],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <h3><?php echo GeneralLabel::acara; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'acaraGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAcara,
        //'filterModel' => $searchModelAcara,
        'id' => 'acaraGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_sukan_acara_id',
            //'jurulatih_sukan_id',
            [
                'attribute' => 'acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::acara,
                ],
                'value' => 'refAcara.desc'
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
                        'onclick' => 'deleteRecordSubModalAjax("'.Url::to(['jurulatih-sukan-acara/delete', 'id' => $model->jurulatih_sukan_acara_id]).'", "'.GeneralMessage::confirmDelete.'", "acaraGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-sukan-acara/update', 'id' => $model->jurulatih_sukan_acara_id]).'", "'.GeneralLabel::updateTitle . ' Acara");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-sukan-acara/view', 'id' => $model->jurulatih_sukan_acara_id]).'", "'.GeneralLabel::viewTitle . ' Acara");',
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
        $jurulatih_sukan_id = "";
        
        if(isset($model->jurulatih_sukan_id)){
            $jurulatih_sukan_id = $model->jurulatih_sukan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['jurulatih-sukan-acara/create', 'jurulatih_sukan_id' => $jurulatih_sukan_id]).'", "'.GeneralLabel::createTitle . ' Acara");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabSukanJurulatihID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $session->close(); ?>

<?php
$URLSetSukan = Url::to(['/jurulatih-sukan/set-sukan']);

$script = <<< JS
        
var sukan_Id = "";
        
        
        
$('#sukanId').change(function(){
    setSukan();
});
        
function setSukan(){
    $.get('$URLSetSukan',{sukan_id:$('#sukanId').val()},function(data){
    });
}
        
$(document).ready(function(){
    setSukan();
});
        
JS;
        
$this->registerJs($script);
?>
