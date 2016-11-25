<?php



use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\Session;

use app\models\Jurulatih;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$disabledTabs = '';

if($this->context->action->id == "create"){
    $disabledTabs = 'disabled';
}

$this->title = GeneralLabel::jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
        // Show some atlet info top of all tabs
        // 
        // get Atlet Id
    
        $jurulatih_id = "";
        
        $session = new Session;
        $session->open();
        if(isset($session['jurulatih_id'])){
            $jurulatih_id = $session['jurulatih_id'];
        }
        $session->close();
        
        $modelJurulatih = null;
        
        if ($jurulatih_id != "" && ($modelJurulatih = Jurulatih::findOne($jurulatih_id)) !== null) {
        }
        
    ?>
    
    <?php if($modelJurulatih !== null && $modelJurulatih->nama): ?>
    <h3><?=$modelJurulatih->nama?></h3>
    <?php endif; ?>
    
    <?php
        if($modelJurulatih !== null && $modelJurulatih->gambar){
            echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$modelJurulatih->gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        }
    ?>
    
    <br>
    <br>
    
    <?php
 
    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-user"></i> '.GeneralLabel::peribadi,
            'content'=>$this->render('_form', [
                'model' => $model,
                'readonly' => $readonly,
            ]),
            'active'=>true,
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-bookmark"></i> Kelayakan',
            'options' => ['id' => GeneralVariable::tabKelayakanID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-spkk','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> '.GeneralLabel::pengalaman,
            'options' => ['id' => GeneralVariable::tabPengalamanID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-pengalaman','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-education"></i> Pendidikan',
            'options' => ['id' => GeneralVariable::tabPendidikanJurulatihID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-pendidikan','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-education"></i> '.GeneralLabel::pendidikan,
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::pendidikan,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabPendidikanJurulatihID],
                    'linkOptions'=>['data-url'=>Url::to(['/jurulatih-pendidikan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::skim_pensijilan_kejurulatihan_kebangsaan_spkk,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKelayakanID],
                    'linkOptions'=>['data-url'=>Url::to(['/jurulatih-spkk','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::kursus_tertinggi_spesifik,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabKelayakanKursusTertinggiID],
                    'linkOptions'=>['data-url'=>Url::to(['/jurulatih-kursus-tertinggi','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-certificate"></i> Kelayakan Kursus Tertinggi',
            'options' => ['id' => GeneralVariable::tabKelayakanKursusTertinggiID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-kursus-tertinggi','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-tint"></i> '.GeneralLabel::kesihatan,
            'options' => ['id' => GeneralVariable::tabKesihatanID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-kesihatan','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-heart"></i> '.GeneralLabel::keluarga,
            'options' => ['id' => GeneralVariable::tabKeluargaJurulatihID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-keluarga','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Atlet',
            'options' => ['id' => GeneralVariable::tabJurulatihAtletID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-atlet','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],*/
        [
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> '.GeneralLabel::atlet_sukan,
            'headerOptions' => ['class'=>$disabledTabs],
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::atlet,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabJurulatihAtletID],
                    'linkOptions'=>['data-url'=>Url::to(['/jurulatih-atlet','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.GeneralLabel::sukan_program,
                    'encode'=>false,
                    'content'=>'&nbsp;',
                    'options' => ['tab_id' => GeneralVariable::tabSukanJurulatihID],
                    'linkOptions'=>['data-url'=>Url::to(['/jurulatih-sukan','typeJson'=>'1'])],
                    'headerOptions' => ['class'=>$disabledTabs]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-stats"></i> '.GeneralLabel::penilaian,
            'options' => ['id' => GeneralVariable::tabJurulatihPenilaianID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-penilaian','typeJson'=>'1'])],
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

