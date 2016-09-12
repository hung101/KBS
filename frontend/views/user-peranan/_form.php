<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// table reference
use app\models\SystemModules;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\UserPeranan */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="user-peranan-form">

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
                         'nama_peranan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],  
                    ],
                ],
            ]
        ]);
        
        echo "<br/>";
        
        $results = SystemModules::find()->where(['=', 'aktif', 1])->orderBy('sort')->all();

        $category = 'MSN';
        $html_fieldsetOpen = '<fieldset style="padding: 10px;">';
        $html_fieldsetClose = '</fieldset><br />';
        $html_inputCheckboxes = '';
        
        $peranan_akses_arr = null;

        if($model->peranan_akses){
            $peranan_akses_arr = json_decode($model->peranan_akses, true);
        }
        
        foreach ($results as $modelSystemModules) {     
            if($category != trim($modelSystemModules->category)){
                echo $html_fieldsetOpen;
                echo '<legend>' . trim($category) . '</legend>';
                if(!$readonly){
                    echo '<strong>Select/Unselect All</strong><br />';
                    echo '<input class="'.trim($category).'" type="checkbox" onclick="checkUncheckAll(this)" value="'.trim($category).'" /> <strong>Module</strong> -  ';
                    echo '<input class="'.trim($category).'_create" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_create" /> <strong>' . GeneralLabel::create . '</strong> ';
                    echo '<input class="'.trim($category).'_update" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_update" /> <strong>' . GeneralLabel::update . '</strong> ';
                    echo '<input class="'.trim($category).'_delete" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_delete" /> <strong>' . GeneralLabel::delete . '</strong> ';
                    echo '<input class="'.trim($category).'_delete" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_others" /> <strong>' . GeneralLabel::other . '</strong> ';
                    echo '<br /><br />';
                }
                echo $html_inputCheckboxes;
                echo $html_fieldsetClose;

                $category = trim($modelSystemModules->category);
                $html_inputCheckboxes = '';
            }
            
            //echo $modelSystemModules->module_name . "<br>";
            
            // Module Access
            $html_inputCheckboxes .= '<input type="checkbox" class="'.trim($modelSystemModules->category).'" name="'
                                    .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="module" '.
                                    (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['module']) ? 'checked' : '') .' '.
                                    ($readonly == true ? 'disabled' : '').' /> '
                                    .trim($modelSystemModules->module_name);
            
            if($modelSystemModules->functions && $modelSystemModules->functions != "no_function;"){
                $html_inputCheckboxes .= ' - ';
            }
            
            if(strpos($modelSystemModules->functions, "no_function;") === false){
            
                // Module Create
                $html_inputCheckboxes .= ' <input type="checkbox" class="'.trim($modelSystemModules->category).'_create" name="'
                                        .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="create" '.
                                        (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['create']) ? 'checked' : '') .' '.
                                        ($readonly == true ? 'disabled' : '').' /> ' . GeneralLabel::create;

                // Module Update
                $html_inputCheckboxes .= ' <input type="checkbox" class="'.trim($modelSystemModules->category).'_update" name="'
                                        .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="update" '.
                                        (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['update']) ? 'checked' : '') .' '.
                                        ($readonly == true ? 'disabled' : '').' /> ' . GeneralLabel::update;

                // Module Delete
                $html_inputCheckboxes .= ' <input type="checkbox" class="'.trim($modelSystemModules->category).'_delete" name="'
                                        .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="delete" '.
                                        (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['delete']) ? 'checked' : '') .' '.
                                        ($readonly == true ? 'disabled' : '').' /> ' . GeneralLabel::delete;
            }
            
            // Other functions
            if($modelSystemModules->functions){
                // Split e.g kelulusan;Kelulusan,sokongan_pn;Sokongan PN
                $arrFunctions = explode(',', $modelSystemModules->functions);
                foreach($arrFunctions as $function){
                    // skip if is empty
                    if($function != ""){
                        // Split e.g kelulusan;Kelulusan
                        $arrFunc = explode(';', $function);
                        
                        // skip those "no_function"
                        if($arrFunc[0] != "no_function"){
                            $arrFunc[1] = trim($arrFunc[1]);

                            $html_inputCheckboxes .= ' <input type="checkbox" class="'.trim($modelSystemModules->category).'_others" name="'
                                            .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="'.$arrFunc[0].'" '.
                                            (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action][$arrFunc[0]]) ? 'checked' : '') .' '.
                                            ($readonly == true ? 'disabled' : '').' /> ' . $arrFunc[1];
                        }
                    }
                }
            }
            
            
            $html_inputCheckboxes .= ' <br />';
        }

        echo $html_fieldsetOpen;
        echo '<legend>' . trim($category) . '</legend>';
        if(!$readonly){
            echo '<input type="checkbox" onclick="checkUncheckAll(this)" value="'.trim($category).'" /> <strong>Select/Unselect All</strong> <br /><br />';
        }
        echo $html_inputCheckboxes;
        echo $html_fieldsetClose;
        
        
        
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'aktif' => [
                            'type'=>Form::INPUT_RADIO_LIST, 
                            'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                            'value'=>1,
                            'options'=>['inline'=>true],
                            'columnOptions'=>['colspan'=>3]],
                    ]
                ],
            ]
        ]);
        ?>
    
        <!--<fieldset style="padding: 10px;">
                <legend>MSN</legend>
                        <input type="checkbox" name="msn[atlet][]" value="module" /> Senarai Atlet <br />
                        <input type="checkbox" name="msn[atlet][]" value="edit" /> Senarai Atlet - Edit<br />
                        <input type="checkbox" name="msn[atlet][]" value="kelulusan" /> Senarai Atlet - Kelulusan<br />
        </fieldset>-->
    <br />


    <!--<?= $form->field($model, 'nama_peranan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'peranan_akses')->textInput(['maxlength' => 80]) ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function checkUncheckAll(thisObj){
        if(thisObj.checked){
            // check all module
            $('.'+ thisObj.value).prop('checked', true);
            
            // check all create
            $('.'+ thisObj.value + '_create').prop('checked', true);
            
            // check all update
            $('.'+ thisObj.value + '_update').prop('checked', true);
            
            // check all delete
            $('.'+ thisObj.value + '_delete').prop('checked', true);
            
            // check all others
            $('.'+ thisObj.value + '_others').prop('checked', true);
        } else {
            // uncheck all module
            $('.'+ thisObj.value).prop('checked', false);
            
            // uncheck all create
            $('.'+ thisObj.value + '_create').prop('checked', false);
            
            // uncheck all update
            $('.'+ thisObj.value + '_update').prop('checked', false);
            
            // uncheck all delete
            $('.'+ thisObj.value + '_delete').prop('checked', false);
            
            // uncheck all others
            $('.'+ thisObj.value + '_others').prop('checked', false);
        }
    }
    
    function checkUncheckAllAction(thisObj){
        var valueArr = thisObj.value.split("_"); 
        
        if(thisObj.checked){
            $('.'+ valueArr[0]).prop('checked', true);
            $('.'+ thisObj.value).prop('checked', true);
        } else {
            $('.'+ thisObj.value).prop('checked', false);
        }
    }
</script>
