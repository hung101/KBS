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

$this->title = GeneralLabel::cetak_profil_atlet_paralimpik;
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
                'maklumat_perhubungan_kecemasan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_oku' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
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
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_sukan_dan_program' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_acara' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_sukan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kewangan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_elaun_atlet' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_keluarga' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_pakaian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_peralatan_sukan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
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
                'maklumat_sekolah_institusi_semasa' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kerjaya_semasa' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_kerjaya' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kursus_kem_semasa' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_kursus_kem' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kaunseling' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_kaunseling' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_kemahiran' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_senarai_kemahiran' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_perubatan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_insurans' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_penderma' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_perubatan_sains_sukan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_insentif' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_penerimaan_insentif' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_penajaan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_penajaan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_biasiswa' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_persatuan_persekutuan_dunia' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_anugerah' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_pencapaian_sukan_semasa' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumat_sejarah_pencapaian_sukan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
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
