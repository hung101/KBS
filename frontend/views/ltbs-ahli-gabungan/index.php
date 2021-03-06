<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsAhliGabunganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::senarai_ahli_gabungan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-badan-sukan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['update']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['delete']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['create']) && Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' '. GeneralLabel::senarai_ahli_gabungan, Url::to(['create', 'profil_badan_sukan_id' => $profil_badan_sukan_id]), ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ahli_gabungan_id',
            //'nama_badan_sukan',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            /*[
                'attribute' => 'badan_sukan',
                'value' => 'refBadanSukan.nama_badan_sukan'
            ],*/
            [
                'attribute' => 'alamat_badan_sukan_1',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat_badan_sukan_1,
                ]
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refStatusLaporanMesyuaratAgung.desc'
            ],
            //'nama_penuh_presiden_badan_sukan',
            //'nama_penuh_setiausaha_badan_sukan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
