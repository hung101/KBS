<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletPendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php 
    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-user"></i> Peribadi',
            'content'=>'',
            'active'=>false,
            'linkOptions'=>['value'=>Url::to(['/atlet/index']),'onclick'=>'Testing()']
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-education"></i> Pendidikan',
            'content'=>'',
            'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-briefcase"></i> Karrier',
            'content'=>'<div id="pendidikan"></div>',
            'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-home"></i> Aset',
            'content'=>'<div id="pendidikan"></div>',
            'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-erase"></i> Perubatan',
            'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Perubatan Atlet',
                 'encode'=>false,
                 'content'=>'<div id="pendidikan"></div>',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
             ],
            [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Sejarah Perubatan',
                 'encode'=>false,
                 'content'=>'<div id="pendidikan"></div>',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Doktor Peribadi',
                 'encode'=>false,
                 'content'=>'<div id="pendidikan"></div>',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
                [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Insurans',
                 'encode'=>false,
                 'content'=>'<div id="pendidikan"></div>',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Donator',
                 'encode'=>false,
                 'content'=>'<div id="pendidikan"></div>',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
        ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-usd"></i> Kewangan',
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Akaun',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pinjaman',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
               [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Elaun',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Insentif',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> Pembangunan Peribadi',
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kursus/Kem',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kaunseling',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
               [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kemahiran',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-flag"></i> Sukan',
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Sukan',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Persatuan/Persekutuan Dunia',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-sunglasses"></i> Pakaian Sukan',
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pakaian Sukan',
                    'encode'=>false,
                    /*'content'=>$this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    ]),*/
                    'content'=>$this->render('create', [
                        'model' => $model,
                    ]),
                    'active'=>true,
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Peralatan Sukan',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-scale"></i> Sukan Pencapaian',
            'items'=>[
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Pencapaian',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Anugerah',
                    'encode'=>false,
                    'content'=>'<div id="pendidikan"></div>',
                    'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
                ],
            ],
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-star"></i> Penajaan Sokongan',
            'content'=>'<div id="sukan"></div>',
            'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-cd"></i> OKU',
            'content'=>'<div id="sukan"></div>',
            'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-heart"></i> Keluarga',
            'content'=>'<div id="sukan"></div>',
            'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
        ],
    ];

// Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'encodeLabels'=>false
]);

?>

</div>
