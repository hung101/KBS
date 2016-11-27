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

$this->title = "".GeneralLabel::penilaian;;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <!--<p>
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabJurulatihPenilaianID.'");']) ?>
    </p>-->
    
    
    <!-- Penilaian - START -->
    
                <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'nama_jurulatih_dinilai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jurulatih_dinilai,
                ],
                'value' => 'refJurulatih.nama'
            ],
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'nama_acara',
            [
                'attribute' => 'nama_acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_acara,
                ],
                'value' => 'refAcara.desc'
            ],
                [
                'attribute' => 'penilaian_oleh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penilaian_oleh,
                ],
                'value' => 'refPenilaianJurulatih.desc'
            ],
                [
                'attribute' => 'tarikh_dinilai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_dinilai,
                ],
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/pengurusan-pemantauan-dan-penilaian-jurulatih/view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    <!-- Penilaian - END -->
    
    

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
