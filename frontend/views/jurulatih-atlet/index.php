<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use yii\helpers\ArrayHelper;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

use app\models\RefStatusTawaran;
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MesyuaratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Atlet";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <!--<p>
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabJurulatihAtletID.'");']) ?>
    </p>-->
    
    
    <!-- Atlet - START -->
    
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
    
    <?php
        $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere('podium = :podium', [':podium' => 0])->all();
        
        // add filter base on sukan access role Atlet -> Podium Kemas Kini - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all();
        }
        // add filter base on sukan access role Atlet -> Podium Kemas Kini - END
        
    ?>
    
                <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'ic_no',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ic_no,
                ]
            ],
            [
                'attribute' => 'name_penuh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::name_penuh,
                ]
            ],
            /*[
                'attribute' => 'tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                ]
            ],*/
            /*[
                'attribute' => 'tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                ],
                'value' => function ($model) {
                    return $model->tawaran == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],*/
            /*[
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                //'value' => 'refAtletSukan.nama_sukan'
                'value'=>function ($model) {
                    if(isset($model->refAtletSukan[0]->nama_sukan) && $sukanModel = RefSukan::find()->where(['=', 'id', $model->refAtletSukan[0]->nama_sukan])->one()){
                        return $sukanModel->desc;
                    } else {
                        return "";
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'sukan', ArrayHelper::map($sukan_list, 'id', 'desc'),['class'=>'form-control','prompt' => '-- Pilih Sukan --']),
            ],*/
            /*[
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                //'value' => 'refAtletSukan.nama_sukan'
                'value'=>function ($model) {
                    if(isset($model->refAtletSukan[0]->program_semasa) && $programModel = RefProgramSemasaSukanAtlet::find()->where(['=', 'id', $model->refAtletSukan[0]->program_semasa])->one()){
                        return $programModel->desc;
                    } else {
                        return "";
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'program', ArrayHelper::map($program_list, 'id', 'desc'),['class'=>'form-control','prompt' => '-- Pilih Program --']),
            ],*/
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/atlet/view', 'id' => $model->atlet_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    <!-- Atlet - END -->
    
    

</div>

<?php
$script = <<< JS
        
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});
     

JS;
        
$this->registerJs($script);
?>
