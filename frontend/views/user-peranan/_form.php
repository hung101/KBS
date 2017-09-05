<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\SystemModules;
use app\models\UserPeranan;
use app\models\RefJabatanUser;
use app\models\RefBahagianUser;
use app\models\RefCawanganUser;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\UserPeranan */
/* @var $form yii\widgets\ActiveForm */

// global variables
$class_color_progress_bar = array(
    "progress-bar progress-bar-aqua", 
    "progress-bar progress-bar-red", 
    "progress-bar progress-bar-green",
    "progress-bar progress-bar-yellow",
    "progress-bar progress-bar-purple",
    );

$class_bootstrap = array(
    "success", 
    "info",
    "warning",
    "danger",
    );

$class_bootstrap_runner = 0;


// filter by agency
$filterAgency=array();

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['msn'])){
    $filterAgency[] = RefJabatanUser::MSN;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['isn'])){
    $filterAgency[] = RefJabatanUser::ISN;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['pjs'])){
    $filterAgency[] = RefJabatanUser::PJS;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['kbs'])){
    $filterAgency[] = RefJabatanUser::KBS;
}


$jabatan_list = RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->all();

if(count($filterAgency) > 0 && Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN){
    $jabatan_list = RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->andFilterWhere(['in', 'id', $filterAgency])->all();
}
?>


<div class="user-peranan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
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
                         'nama_peranan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>80]],  
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'jabatan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-jabatan-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map($jabatan_list,'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::jabatan],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        'bahagian' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DepDrop', 
                            'options'=>[
                                'type'=>DepDrop::TYPE_SELECT2,
                                'select2Options'=> [
                                    'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                    [
                                        'append' => [
                                            'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                            'asButton' => true
                                        ]
                                    ] : null,
                                    'pluginOptions'=>['allowClear'=>true]
                                ],
                                'data'=>ArrayHelper::map(RefBahagianUser::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options'=>['prompt'=>'',],
                                'pluginOptions' => [
                                    'initialize' => true,
                                    'depends'=>[Html::getInputId($model, 'jabatan')],
                                    'placeholder' => Placeholder::bahagian,
                                    'url'=>Url::to(['/ref-bahagian-user/subbahagians'])],
                                ],
                            'columnOptions'=>['colspan'=>3]],
                        'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-cawangan-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefCawanganUser::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'bahagian')],
                            'placeholder' => Placeholder::cawangan,
                            'url'=>Url::to(['/ref-cawangan-user/subbahagiancawangans'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                    ]
                ],
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
                    ],
                ],
            ]
        ]);
        
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN && !$readonly){
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'agensi' => [
                    'type'=>Form::INPUT_CHECKBOX_LIST, 
                    'items'=>ArrayHelper::map(RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->all(),'id', 'desc'),
    //['Sarapan'=>'Sarapan', 'Tengahari'=>'Tengahari', 'Malam'=>'Malam'],
                    'options'=>[
                        'inline'=>true,
                        'item'=>function ($index, $label, $name, $checked, $value){
                            /*return Html::checkbox($name, $checked, [
                               'value' => $value,
                               'label' => $label . '&nbsp;&nbsp;',
                               'class' => 'filter-' . $label,
                               'checked' => true,
                            ]);*/
                            
                            return '<label class="checkbox-inline">'
                                    . '<input class="filter-'.$label.'" name="UserPeranan[agensi][]" value="'.$value.'" type="checkbox" checked>' . $label . 
                                    '</label>';
                        },
                    ],
                    'columnOptions'=>['colspan'=>5]],
            ],
        ],
    ]
]);
        }
        
        echo "<br/>";
        
        // DASHBOARD - START
        
        $results = SystemModules::find()->where(['=', 'aktif', 1])->orderBy('new_sort')->all();

        $category = '';
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN'])){
            $category = 'MSN';
        } else if(isset(Yii::$app->user->identity->peranan_akses['ISN'])){
            $category = 'ISN';
        } else if(isset(Yii::$app->user->identity->peranan_akses['PJS'])){
            $category = 'PJS';
        } else if(isset(Yii::$app->user->identity->peranan_akses['KBS'])){
            $category = 'KBS';
        } else if(isset(Yii::$app->user->identity->peranan_akses['Admin'])){
            $category = 'Admin';
        }
        
        $category_menu_1 = '';
        $category_menu_2 = '';
        $category_menu_3 = '';
        $category_menu_4 = '';
        $category_menu_5 = '';
        
        $html_fieldsetOpen = '<fieldset style="padding: 10px;">';
        $html_fieldsetClose = '</fieldset>';
        $html_inputCheckboxes = '';
        
        $peranan_akses_arr = null;

        if($model->peranan_akses){
            $peranan_akses_arr = json_decode($model->peranan_akses, true);
        }
        
        foreach ($results as $modelSystemModules) {  
            $category_menu_1_changed = false;
            
            $category = str_replace(" ","_",$modelSystemModules->category_menu_1);
            
            if(isset(Yii::$app->user->identity->peranan_akses[trim($modelSystemModules->category)][$modelSystemModules->action]['admin']) ||
                    Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN){
            if($category_menu_1 != trim($modelSystemModules->category_menu_1) && (isset(Yii::$app->user->identity->peranan_akses[$modelSystemModules->category]))){
                if($category_menu_1 != '') { 
                    // TABLE - CLOSE
                    echo '</table>';
            
                    // CATEGORY MENU 2 - CLOSE   
                    echo '  </div>
                      </div>';
                    
                    // CATEGORY MENU 1 - CLOSE
                    echo '</div>';
                    echo '<br><br>'; 
                }
                
                echo '<div id="dashboard-content">';
                echo $html_fieldsetOpen;
                echo '<legend>' . trim($modelSystemModules->category_menu_1) . '</legend>';
                if(!$readonly){
                    echo '<strong>Pilih Semua</strong><br />';
                    echo '<input class="'.trim($category).'" type="checkbox" onclick="checkUncheckAll(this)" value="'.trim($category).'" /> <strong>' . GeneralLabel::modul . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
                    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN){
                        echo '<input class="'.trim($category).'_admin" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_admin" /> <strong>' . GeneralLabel::admin . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
                    }
                    
                    if(
                    trim($modelSystemModules->category_menu_2) != 'Sistem' ){
                        echo '<input class="'.trim($category).'_create" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_create" /> <strong>' . GeneralLabel::create . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo '<input class="'.trim($category).'_update" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_update" /> <strong>' . GeneralLabel::update . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo '<input class="'.trim($category).'_delete" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_delete" /> <strong>' . GeneralLabel::delete . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo '<input class="'.trim($category).'_delete" type="checkbox" onclick="checkUncheckAllAction(this)" value="'.trim($category).'_others" /> <strong>' . GeneralLabel::other . '</strong> ';
                    }
                    echo '<br />';
                }
                echo $html_inputCheckboxes;
                echo $html_fieldsetClose;

                $category_menu_1 = trim($modelSystemModules->category_menu_1);
                $category_menu_1_changed = true;
                $html_inputCheckboxes = '';
            }
            
            if($category_menu_2 != trim($modelSystemModules->category_menu_2)){

                // change color different div box
                $div_box_color = $class_bootstrap[$class_bootstrap_runner];
                $class_bootstrap_runner ++;
                if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
                
                if($category_menu_2 != '' && !$category_menu_1_changed){
                    // CATEGORY MENU 2 - CLOSE   
                    // TABLE - CLOSE
                    echo '</table>';
                    echo '  </div>
                      </div>';
                }
            
                // CATEGORY MENU 2 - OPEN
                echo '<div class="box box-'.$div_box_color.'">
                        <div class="box-header with-border">
                          <h3 class="box-title"><i class="fa fa-bars"></i> '.trim($modelSystemModules->category_menu_2).'</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body nav-tabs-custom">';
                
                // TABLE - OPEN
                echo '<table class="table table-hover table-bordered">';
                
                $admin_header_col = Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN ? '<th style="width: 7%">'.GeneralLabel::admin.'</th>' : '';
                
                if(trim($modelSystemModules->category_menu_2) != 'Dashboard' &&
                    trim($modelSystemModules->category_menu_2) != 'Sistem' ){
                echo '<tr class="'.trim($modelSystemModules->category).'" style="background-color:#9ca1a8;">
                        <th style="width: 36%">'.GeneralLabel::modul.'</th>
                        '.$admin_header_col.'
                        <th style="width: 7%">'.GeneralLabel::save.'</th>
                        <th style="width: 7%">'.GeneralLabel::update.'</th>
                        <th style="width: 7%">'.GeneralLabel::delete.'</th>
                        <th style="width: 36%">'.GeneralLabel::lain_lain.'</th>
                     </tr>';
                } else {
                    echo '<tr style="background-color:#9ca1a8;">
                            <th style="width: 36%">'.GeneralLabel::modul.'</th>
                            '.$admin_header_col.'
                            <th style="width: 57%">'.GeneralLabel::lain_lain.'</th>
                         </tr>';
                }
                
                $category_menu_2 = trim($modelSystemModules->category_menu_2);
            }
            
            
            
            if($category_menu_3 != trim($modelSystemModules->category_menu_3)){

                // change color different div box
                $div_box_color = $class_bootstrap[$class_bootstrap_runner];
                $class_bootstrap_runner ++;
                if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
                
                if($category_menu_2 != '' && !$category_menu_1_changed){
                    // CATEGORY MENU 3 - CLOSE   
                    echo '  </div>
                      </div>';
                }
            
                // CATEGORY MENU 3 - OPEN
                echo '<tr class="'.trim($modelSystemModules->category).'"><td colspan="6" class="modul-header-row" style="padding-top: 25px; background-color:#f4f4f4; text-decoration: underline; font-weight: bold;">'.
                        trim($modelSystemModules->category_menu_3).'</td></tr>';
                
                $category_menu_3 = trim($modelSystemModules->category_menu_3);
            }
            
            
            //echo $modelSystemModules->module_name . "<br>";
            //
            
            // Module Access
            $moduleName = '';
            if($modelSystemModules->category_menu_4 != ''){
                $moduleName.=$modelSystemModules->category_menu_4 . ' -> ';
            }
            
            if($modelSystemModules->category_menu_5 != ''){
                $moduleName.=$modelSystemModules->category_menu_5 . ' -> ';
            }
            
            $moduleName.=trim($modelSystemModules->module_name);
            
            //if((Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN && $moduleName != 'Peranan Pengguna') || Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN){
                echo '<tr class="'.trim($modelSystemModules->category).'">';
                
                if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN || 
                        isset(Yii::$app->user->identity->peranan_akses[trim($modelSystemModules->category)][$modelSystemModules->action]['module'])){
                    echo '<td>';
                    echo '<input type="checkbox" class="'.$category.' '.trim($modelSystemModules->category).'_agency" name="'
                                            .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="module" '.
                                            (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['module']) ? 'checked' : '') .' '.
                                            ($readonly == true ? 'disabled' : '').' /> '
                                            .$moduleName;
                    echo '</td>';
                }

                if($modelSystemModules->functions && $modelSystemModules->functions != "no_function;"){
                    //echo ' - ';
                }

                // Admin Access
                if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN){
                    echo '<td>';
                    if($moduleName != 'Peranan Pengguna'){ // hide for Peranan Pengguna
                    echo '<input type="checkbox" class="'.$category.'_admin '.trim($modelSystemModules->category).'_agency" name="'
                                        .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="admin"' .
                                        (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['admin']) ? 'checked' : '') .' '.
                                        ($readonly == true ? 'disabled' : '').' /> '
                                        .GeneralLabel::admin.' ';
                    }
                    echo '</td>';
                }

                if(strpos($modelSystemModules->functions, "no_function;") === false){

                    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN || 
                        isset(Yii::$app->user->identity->peranan_akses[trim($modelSystemModules->category)][$modelSystemModules->action]['create'])){
                        // Module Create
                        echo '<td>';
                        echo ' <input type="checkbox" class="'.$category.'_create '.trim($modelSystemModules->category).'_agency" name="'
                                                .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="create" '.
                                                (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['create']) ? 'checked' : '') .' '.
                                                ($readonly == true ? 'disabled' : '').' /> ' . GeneralLabel::create;
                        echo '</td>';
                    }

                    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN || 
                        isset(Yii::$app->user->identity->peranan_akses[trim($modelSystemModules->category)][$modelSystemModules->action]['update'])){
                        // Module Update
                        echo '<td>';
                        echo ' <input type="checkbox" class="'.$category.'_update '.trim($modelSystemModules->category).'_agency" name="'
                                                .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="update" '.
                                                (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['update']) ? 'checked' : '') .' '.
                                                ($readonly == true ? 'disabled' : '').' /> ' . GeneralLabel::update;
                        echo '</td>';
                    }

                    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN || 
                        isset(Yii::$app->user->identity->peranan_akses[trim($modelSystemModules->category)][$modelSystemModules->action]['delete'])){
                        // Module Delete
                        echo '<td>';
                        echo ' <input type="checkbox" class="'.$category.'_delete '.trim($modelSystemModules->category).'_agency" name="'
                                                .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="delete" '.
                                                (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action]['delete']) ? 'checked' : '') .' '.
                                                ($readonly == true ? 'disabled' : '').' /> ' . GeneralLabel::delete;
                        echo '</td>';
                    }
                }

                // Other functions
               echo '<td>';
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
                                if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_ADMIN || 
                                    isset(Yii::$app->user->identity->peranan_akses[trim($modelSystemModules->category)][$modelSystemModules->action][$arrFunc[0]])){
                                    echo '<input type="checkbox" class="'.$category.'_others '.trim($modelSystemModules->category).'_agency" name="'
                                                    .trim($modelSystemModules->category).'['.trim($modelSystemModules->action).'][]" value="'.$arrFunc[0].'" '.
                                                    (isset($peranan_akses_arr[trim($modelSystemModules->category)][$modelSystemModules->action][$arrFunc[0]]) ? 'checked' : '') .' '.
                                                    ($readonly == true ? 'disabled' : '').' /> ' . $arrFunc[1] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                }
                            }
                        }
                    }
                }
                echo '</td>';
                echo '</tr>';
            //}
            
            //echo ' <br />';
            
            }
        }
        // TABLE - CLOSE
        echo '</table>';
                    
        // CATEGORY MENU 2 - CLOSE   
        echo '  </div>
          </div>';
        
        echo '</div>'; // category-menu 1 closed
        
        
        
        /*echo FormGrid::widget([
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
        ]);*/
        ?>
    
        <!--<fieldset style="padding: 10px;">
                <legend>MSN</legend>
                        <input type="checkbox" name="msn[atlet][]" value="module" /> Senarai Atlet <br />
                        <input type="checkbox" name="msn[atlet][]" value="edit" /> Senarai Atlet - Edit<br />
                        <input type="checkbox" name="msn[atlet][]" value="kelulusan" /> Senarai Atlet - Kelulusan<br />
        </fieldset>-->

    
    <!--<?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>-->

    <br>
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
            
            // check all others
            $('.'+ thisObj.value + '_admin').prop('checked', true);
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
            
            // uncheck all others
            $('.'+ thisObj.value + '_admin').prop('checked', false);
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


<?php
$MSN = RefJabatanUser::MSN;
$ISN = RefJabatanUser::ISN;
$PJS = RefJabatanUser::PJS;
$KBS = RefJabatanUser::KBS;

$script = <<< JS
        
$(document).ready(function(){
    //$(':checkbox').attr("checked", true)
});
  
$(':checkbox').change(function() {
    var checkbox_value = $(this).val();
    var is_checked = $(this).prop('checked');
    var classAgency = '';
        
    if(checkbox_value == "$MSN"){
        classAgency = "MSN";
    }else if(checkbox_value == "$ISN"){
        classAgency = "ISN";
    }else if(checkbox_value == "$PJS"){
        classAgency = "PJS";
    }else if(checkbox_value == "$KBS"){
        classAgency = "KBS";
    }
        
    if(is_checked){
        // show agency modules
        $("." + classAgency).show();
    } else {
        // hide agency modules
        $("." + classAgency).hide();
        
        // uncheck agency modules
        $('.'+ classAgency + '_agency').prop('checked', false);
    }
}); 
        
JS;
        
$this->registerJs($script);
?>
