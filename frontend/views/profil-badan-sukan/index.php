<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfilBadanSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::profil_badan_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-badan-sukan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['create']) && !Yii::$app->user->identity->profil_badan_sukan): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::profil_badan_sukan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profil_badan_sukan',
            [
                'attribute' => 'nama_badan_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_badan_sukan,
                ]
            ],
            [
                'attribute' => 'nama_badan_sukan_sebelum_ini',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_badan_sukan_sebelum_ini,
                ]
            ],
            //'no_pendaftaran_sijil_pendaftaran',
            [
                'attribute' => 'no_pendaftaran_sijil_pendaftaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_pendaftaran_sijil_pendaftaran,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->no_pendaftaran_sijil_pendaftaran){
                        return Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->no_pendaftaran_sijil_pendaftaran , [ 'target'=>'_blank']);
                    } else {
                        return "";
                    }
                },
            ],
            //'tarikh_lulus_pendaftaran',
            [
                'attribute' => 'tarikh_lulus_pendaftaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_lulus_pendaftaran,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_lulus_pendaftaran);
                },
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refStatusLaporanMesyuaratAgung.desc'
            ],
            // 'jenis_sukan',
            // 'alamat_tetap_badan_sukan',
            // 'alamat_surat_menyurat_badan_sukan',
            // 'no_telefon_pejabat',
            // 'no_faks_pejabat',
            // 'emel_badan_sukan',
            // 'pengiktirafan_yang_pernah_diterima_badan_sukan',

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
