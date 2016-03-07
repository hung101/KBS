<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfilBadanSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil Badan Sukan';
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

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Profil Badan Sukan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profil_badan_sukan',
            'nama_badan_sukan',
            'nama_badan_sukan_sebelum_ini',
            //'no_pendaftaran_sijil_pendaftaran',
            [
                'attribute' => 'no_pendaftaran_sijil_pendaftaran',
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
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_lulus_pendaftaran);
                },
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
