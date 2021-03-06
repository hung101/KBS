<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefTahapKpsk;
use app\models\RefUniversitiInstitusiEBiasiswa;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpsk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-profil-peserta-kpsk-form">
    
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
        
        $template .= ' {surat}';
    ?>
    
    <?php 
    $isPersatuan = false; // default
    if(!Yii::$app->user->isGuest && Yii::$app->user->identity->profil_badan_sukan){
        $isPersatuan = true;
    }
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    
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
                'penganjur_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80, 'disabled' => $disabled]],
                'kod_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>30, 'disabled' => $disabled]],
                'tarikh_kursus' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options'=>['disabled' => $disabled],
                    ],
                    'columnOptions'=>['colspan'=>3]],
				'tarikh_tamat_kursus' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
						'options'=>['disabled' => $disabled],
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
        ?>
    
    <div class="row">
        <div class="col-sm-3">
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
		'tahap' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-tahap-kpsk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTahapKpsk::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tahap, 'id' => 'tahapID', 'disabled' => $disabled],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>12]],
            ]
        ],
    ]
]);
        ?>
        </div>
    </div>
    
    <h3><?php echo GeneralLabel::peserta_kursus; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'borangProfilPesertaKpskPesertaGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBorangProfilPesertaKpskPeserta,
        //'filterModel' => $searchModelBorangProfilPesertaKpskPeserta,
        'id' => 'borangProfilPesertaKpskPesertaGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'borang_profil_peserta_kpsk_peserta_id',
            //'borang_profil_peserta_kpsk_id',
            'nama',
            'no_kad_pengenalan',
            [
                'attribute' => 'tarikh_lahir',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_lahir, GeneralFunction::TYPE_DATE);
                },
            ],
            // 'umur',
            // 'jantina',
            // 'bangsa',
            // 'agama',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_telefon',
            // 'no_telefon_bimbit',
            // 'emel',
            // 'facebook',
            // 'akademik',
            // 'pekerjaan',
            // 'nama_majikan',
            //'keputusan',
            [
                'attribute' => 'keputusan',
                'value'=> 'refKeputusanKpsk.desc'
            ],
            // 'objektif',
            // 'struktur',
            // 'esei',
            // 'jumlah',
            // 'catatan',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['borang-profil-peserta-kpsk-peserta/delete', 'id' => $model->borang_profil_peserta_kpsk_peserta_id]).'", "'.GeneralMessage::confirmDelete.'", "borangProfilPesertaKpskPesertaGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['borang-profil-peserta-kpsk-peserta/update', 'id' => $model->borang_profil_peserta_kpsk_peserta_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::peserta_kursus.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['borang-profil-peserta-kpsk-peserta/view', 'id' => $model->borang_profil_peserta_kpsk_peserta_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::peserta_kursus.'");',
                        ]);
                    },
                    'surat' => function ($url, $model) {
                        return  Html::a('<span class="glyphicon glyphicon-file"></span>', 
                        ['borang-profil-peserta-kpsk-peserta/surat-keputusan', 'borang_profil_peserta_kpsk_peserta_id' =>$model->borang_profil_peserta_kpsk_peserta_id], 
                        [
                            'title' => GeneralLabel::surat_keputusan,
                            'target' => '_blank',
                            'class' => 'custom_button',
                            'value'=>Url::to(['/borang-profil-peserta-kpsk-peserta/surat-keputusan', 'borang_profil_peserta_kpsk_peserta_id' =>$model->borang_profil_peserta_kpsk_peserta_id])
                        ]);
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $borang_profil_peserta_kpsk_id = "";
        
        if(isset($model->borang_profil_peserta_kpsk_id)){
            $borang_profil_peserta_kpsk_id = $model->borang_profil_peserta_kpsk_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['borang-profil-peserta-kpsk-peserta/create', 'borang_profil_peserta_kpsk_id' => $borang_profil_peserta_kpsk_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::peserta_kursus.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URL_SET_TAHAP = Url::to(['/borang-profil-peserta-kpsk/set-tahap']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
var isPersatuan = '$isPersatuan';
        
$.fn.modal.Constructor.prototype.enforceFocus = function () {};
        
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});

$('#tahapID').change(function(){
    changeTahap();
});

function changeTahap(){
    $.get('$URL_SET_TAHAP',{tahap_id:$('#tahapID').val()},function(data){
    });
}
     

JS;
        
$this->registerJs($script);
?>

