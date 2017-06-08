<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

use app\models\RefStatusLaporanMesyuaratAgung;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = GeneralLabel::daftar;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>Please fill out the following fields to signup:</p>-->

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <?php //echo $form->errorSummary($model); ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => 30])->hint('Sila guna No Pendaftaran Persatuan. Cth: ppm/001') ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 160]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'tel_bimbit_no')->textInput(['maxlength' => 14]) ?>
            <?= $form->field($model, 'nama_persatuan_e_bantuan')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'jawatan_e_bantuan')->textInput(['maxlength' => 80]) ?>
            <?php echo "<div class='required'>"; ?>
            <?= $form->field($model, 'sijil_pendaftaran')->fileInput() ?>
            <span id="sijilFile"></span>
            <?php echo "</div>"; ?>
            <?php echo "<div class='required'>"; ?>
            <?= $form->field($model, 'perlembagaan_persatuan')->fileInput() ?>
            <?php echo "</div>"; ?>
                <div class="form-group">
                    <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$URL = Url::to(['/profil-badan-sukan/get-badan-sukan-by-no-pendaftaran']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$DISAHKAN = RefStatusLaporanMesyuaratAgung::DISAHKAN;
$BASE_URL = \Yii::$app->request->BaseUrl;

$script = <<< JS
 
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    
    
    $.get('$URL',{no_pendaftaran:$('#signupebantuanform-username').val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            if(data.status === '$DISAHKAN'){
                return true;
            } else {
                alert("Badan sukan tersebut belum disahkan");
            
                return false;
            }
        }
    });
});
        
$('#signupebantuanform-username').focusout(function(){
    //alert($(this).val());
    validateBadanSukan();
});
            
function validateBadanSukan(){
    $('#signupebantuanform-nama_persatuan_e_bantuan').prop("disabled", false);
    
    $.get('$URL',{no_pendaftaran:$('#signupebantuanform-username').val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            if(data.status === '$DISAHKAN'){
                $('#signupebantuanform-nama_persatuan_e_bantuan').attr('value',data.nama_badan_sukan);
                $('#signupebantuanform-nama_persatuan_e_bantuan').prop("disabled", true);
                $('#signupebantuanform-nama_persatuan_e_bantuan').attr('value',data.nama_badan_sukan);
                
                var URL_SIJIL_FILE = '<a class="btn btn-link" href="$BASE_URL/'+data.no_pendaftaran_sijil_pendaftaran+'" target="_blank">Papar Attachment</a><br><br>';
                $("#signupebantuanform-sijil_pendaftaran").remove(); 
                $('#sijilFile').html(URL_SIJIL_FILE);
            
                return true;
            } else {
                alert("Badan sukan tersebut belum disahkan");
            
                return false;
            }
        }
    });
}
     
function clearForm(){
    $('#signupebantuanform-nama_persatuan_e_bantuan').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
