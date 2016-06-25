<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\Session;

use app\models\Atlet;
use app\models\AtletSukan;

use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$disabledTabs = '';

if($this->context->action->id == "create"){
    $disabledTabs = 'disabled';
}

$this->title = GeneralLabel::atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
        // Show some atlet info top of all tabs
        // 
        // get Atlet Id
    
        $atlet_id = "";
        
        $session = new Session;
        $session->open();
        if(isset($session['atlet_id'])){
            $atlet_id = $session['atlet_id'];
        }
        $session->close();
        
        $modelAtlet = null;
        
        if ($atlet_id != "" && ($modelAtlet = Atlet::findOne($atlet_id)) !== null) {
        }
        
        $modelSukanProgram = AtletSukan::find()->joinWith(['refSukan'])
                ->joinWith(['refAcara'])
                ->joinWith(['refProgramSemasaSukanAtlet'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $atlet_id])->orderBy(['created' => SORT_DESC,])->one();
    ?>
    
    <h3><?=$modelAtlet->name_penuh?></h3>
    
    <?php
        if($modelAtlet !== null && $modelAtlet->gambar){
            echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$modelAtlet->gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        }
    ?>
    
    <div class="row" style="margin-top:15px; margin-bottom: 15px">
        <div class="col-lg-2">
            <?php if(isset($modelSukanProgram['refProgramSemasaSukanAtlet']['desc'])): ?>
            <label class="control-label"><?=GeneralLabel::program?></label>
            <div class="form-control-static"><?=$modelSukanProgram['refProgramSemasaSukanAtlet']['desc']?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-2">
            <?php if(isset($modelSukanProgram['refSukan']['desc'])): ?>
            <label class="control-label"><?=GeneralLabel::sukan?></label>
            <div class="form-control-static"><?=$modelSukanProgram['refSukan']['desc']?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-2">
            <?php if(isset($modelSukanProgram['refAcara']['desc'])): ?>
            <label class="control-label"><?=GeneralLabel::discipline?></label>
            <div class="form-control-static"><?=$modelSukanProgram['refAcara']['discipline']?></div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php 
    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-user"></i> Peribadi',
            'content'=>$this->render('_form', [
                'model' => $model,
                'readonly' => $readonly,
            ]),
            'active'=>true,
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> Pendidikan / Kerjaya / Pembangunan Peribadi',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pendidikan',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPendidikanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pendidikan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kerjaya',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKarrierID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-karier','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kursus/Kem',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPembangunanKursuskemID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pembangunan-kursuskem','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kaunseling',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPembangunanKaunselingID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pembangunan-kaunseling','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
               [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kemahiran',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPembangunanKemahiranID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pembangunan-kemahiran','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-home"></i> Aset',
            'options' => ['id' => GeneralVariable::tabAsetID],
            'linkOptions'=>['data-url'=>Url::to(['/atlet-aset','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-erase"></i> Perubatan',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Perubatan',
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan/update','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs]
             ],
            [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Sejarah Perubatan',
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanSejarahID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-sejarah','typeJson'=>'1'])],
                'headerOptions' => ['class'=>$disabledTabs]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Doktor Peribadi',
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanDoktorID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-doktor','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs]
             ],
                [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Insurans',
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanInsuransID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-insurans','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pederma',
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanDonatorID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-donator','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs]
             ],
        ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-usd"></i> Kewangan & Penajaan',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Akaun',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganAkaunID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-akaun','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
               [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Elaun',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganElaunID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-elaun','typeJson'=>'1'])],
                   'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Insentif',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganInsentifID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-insentif','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Penajaan',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPenajaanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-penajaansokongan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> Pembangunan Peribadi',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                
            ],
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-flag"></i> Program & Sukan',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Program & Sukan',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabSukanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-sukan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Persatuan / Persekutuan Dunia',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabSukanPersatuanpersekutuanduniaID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-sukan-persatuanpersekutuandunia','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-sunglasses"></i> Kelengkapan Sukan',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pakaian Sukan',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPakaianSukanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pakaian','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Peralatan Sukan',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPeralatanSukanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pakaian-peralatan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-scale"></i> Pencapaian Sukan',
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pencapaian',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPencapaianID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pencapaian','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Anugerah',
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPencapaianAnugerahID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pencapaian-anugerah','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-star"></i> Penajaan',
            'content'=>'&nbsp;',
            'options' => ['id' => GeneralVariable::tabPenajaanID],
            'linkOptions'=>['data-url'=>Url::to(['/atlet-penajaansokongan/update','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-cd"></i> OKU',
            'content'=>'&nbsp;',
            'options' => ['id' => GeneralVariable::tabOKUID],
            'linkOptions'=>['data-url'=>Url::to(['/atlet-oku','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-heart"></i> Keluarga',
            'content'=>'&nbsp;',
            'options' => ['id' => GeneralVariable::tabKeluargaID],
            'linkOptions'=>['data-url'=>Url::to(['/atlet-keluarga','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
    ];

// Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'encodeLabels'=>false,
]);

?>

</div>
