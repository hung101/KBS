<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\Session;

use app\models\Atlet;
use app\models\AtletSukan;
use app\models\RefStatusTawaran;

use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$disabledTabs = '';

$visibleTabsDuringCadangan = true;
$visibleAfterLulus = true;

if($this->context->action->id == "create"){
    $disabledTabs = 'disabled';
}

    // Session
    $session = new Session;
    $session->open();
    
    $index_view = 'index';
    $label_title = GeneralLabel::senarai_atlet;
    $visibleOKUTab = false;
    
    if(isset($session['atlet_cacat']) &&  $session['atlet_cacat']){
        $index_view = 'index-cacat';
        $label_title = GeneralLabel::senarai_atlet_cacat;
        $visibleOKUTab = true;
    }

$this->title = GeneralLabel::atlet;
$this->params['breadcrumbs'][] = ['label' => $label_title, 'url' => [$index_view]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
        // Show some atlet info top of all tabs
        // 
        // get Atlet Id
    
        $atlet_id = "";
        
        if(isset($session['atlet_id'])){
            $atlet_id = $session['atlet_id'];
        }
        
        $modelAtlet = null;
        
        if ($atlet_id != "" && ($modelAtlet = Atlet::findOne($atlet_id)) !== null) {
            if($modelAtlet->tawaran == RefStatusTawaran::LULUS_TAWARAN){
                $visibleAfterLulus = true;
            } else {
                $visibleAfterLulus = false;
            }
        }
        
        $modelSukanProgram = AtletSukan::find()->joinWith(['refSukan'])
                ->joinWith(['refAcara'])
                ->joinWith(['refProgramSemasaSukanAtlet'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $atlet_id])->orderBy(['tarikh_mula_menyertai_program_msn' => SORT_DESC,])->one();
    ?>
    
    <?php if($modelAtlet !== null && $modelAtlet->name_penuh): ?>
    <h3><?=$modelAtlet->name_penuh?></h3>
    <?php endif; ?>
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
        <!--<div class="col-lg-2">
            <?php if(isset($modelSukanProgram['refAcara']['desc'])): ?>
            <label class="control-label"><?=GeneralLabel::discipline?></label>
            <div class="form-control-static"><?=$modelSukanProgram['refAcara']['discipline']?></div>
            <?php endif; ?>
        </div>-->
    </div>
    
    <?php 
    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-user"></i> '.GeneralLabel::peribadi,
            'content'=>$this->render('_form', [
                'model' => $model,
                'readonly' => $readonly,
                'mesyuarat_id' => $mesyuarat_id,
            ]),
            'active'=>true,
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> '.GeneralLabel::pendidikan_Kerjaya_Pembangunan_Peribadi,
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::pendidikan,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPendidikanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pendidikan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleTabsDuringCadangan
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::kerjaya,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKarrierID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-karier','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleTabsDuringCadangan
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::kursus_kem,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPembangunanKursuskemID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pembangunan-kursuskem','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::kaunseling,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPembangunanKaunselingID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pembangunan-kaunseling','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
               [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::kemahiran,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPembangunanKemahiranID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pembangunan-kemahiran','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
            ],
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-home"></i> Aset',
            'options' => ['id' => GeneralVariable::tabAsetID],
            'linkOptions'=>['data-url'=>Url::to(['/atlet-aset','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs] '.GeneralLabel::kaunseling,
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-erase"></i> '.GeneralLabel::perubatan_sains_sukan,
            'headerOptions' => ['class'=>$disabledTabs],
            'visible' => $visibleAfterLulus,
            'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::perubatan,
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan/update','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
             ],
            /*[
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
             ],*/
                [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::insurans,
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanInsuransID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-insurans','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::penderma,
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanDonatorID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-donator','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::rekods,
                 'encode'=>false,
                 'content'=>'&nbsp;',
                 'options' => ['tab_id' => GeneralVariable::tabPerubatanRekodsID],
                 'linkOptions'=>['data-url'=>Url::to(['/atlet-perubatan-rekods','typeJson'=>'1'])],
                 'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
             ],
        ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-usd"></i> '.GeneralLabel::kewangan_penajaan,
            'headerOptions' => ['class'=>$disabledTabs],
            'visible' => $visibleAfterLulus,
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::akaun,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganAkaunID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-akaun','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
               [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::elaun,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganElaunID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-elaun','typeJson'=>'1'])],
                   'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::insentif,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganInsentifID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-insentif','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::penajaan,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPenajaanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-penajaansokongan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::biasiswa,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKewanganBiasiswaID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-kewangan-biasiswa','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
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
            'label'=>'<i class="glyphicon glyphicon-flag"></i>  '.GeneralLabel::program_sukan,
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::program_sukan,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabSukanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-sukan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleTabsDuringCadangan
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::persatuan_persekutuan_dunia,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabSukanPersatuanpersekutuanduniaID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-sukan-persatuanpersekutuandunia','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-sunglasses"></i> '.GeneralLabel::kelengkapan_sukan,
            'headerOptions' => ['class'=>$disabledTabs],
            'visible' => $visibleAfterLulus,
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::pakaian_sukan,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPakaianSukanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pakaian','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::peralatan_sukan,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPeralatanSukanID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pakaian-peralatan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-scale"></i> '.GeneralLabel::pencapaian_sukan,
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::pencapaian,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPencapaianID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pencapaian','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleTabsDuringCadangan
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::anugerah,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPencapaianAnugerahID],
                    'linkOptions'=>['data-url'=>Url::to(['/atlet-pencapaian-anugerah','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs],
                    'visible' => $visibleAfterLulus
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
            'headerOptions' => ['class'=>$disabledTabs],
            'visible' => ($visibleOKUTab && $visibleAfterLulus)
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-heart"></i> '.GeneralLabel::keluarga,
            'content'=>'&nbsp;',
            'options' => ['id' => GeneralVariable::tabKeluargaID],
            'linkOptions'=>['data-url'=>Url::to(['/atlet-keluarga','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs],
            'visible' => $visibleTabsDuringCadangan
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

<?php $session->close(); ?>
