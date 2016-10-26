<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = GeneralLabel::cetak_profil_jurulatih;
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss(".checkbox { margin-top: 0 !important; margin-bottom: 0px !important;}"
        . " .form-group { margin-bottom: 0px !important;}");
?>
<div class="laporan-penganjuran-acara">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p><label><input type="checkbox" id="checkAll"/> <?=GeneralLabel::pilih_semua?></label></p>
    
    <hr>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
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
                'maklumat_diri' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_pelantikan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sukan_dan_program' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_acara' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_atlet' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kesihatan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_keluarga_jika_berlaku_kecemasan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_pendidikan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_majikan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_skim_pensijilan_kejurulatihan_kebangsaan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kelayakan_kursus_tertinggi_spesifik' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_penilaian_ketua_jurulatih' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_penilaian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_tawaran' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton(GeneralLabel::generate, ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
        
$(document).ready(function(){
    $('input:checkbox').prop('checked', this.checked);
});
        
$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
JS;
        
$this->registerJs($script);
?>
