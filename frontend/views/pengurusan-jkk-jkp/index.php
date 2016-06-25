<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanJkkJkpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_jkkjkp;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_jkkjkp, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_jkk_jkp_id',
            //'nama_setiausaha_jkk_jkp',
            //'jenis_cawangan_kuasa',
            [
                'attribute' => 'nama_pegawai_coach',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pegawai_coach,
                ],
                //'value' => 'refNamaAhliJkkJkp.desc'
            ],
            [
                'attribute' => 'jenis_cawangan_kuasa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_cawangan_kuasa,
                ],
                'value' => 'refJenisCawanganKuasaJkkJkp.desc'
            ],
            [
                'attribute' => 'tarikh_pelantikan_jkk_jkp',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_pelantikan_jkk_jkp,
                ]
            ],
            /*[
                'attribute' => 'tempoh_hak_jkk_jkp',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tempoh_hak_jkk_jkp,
                ]
            ],*/
            //'status',
            /*[
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refStatusJkkJkp.desc'
            ],*/
            // 'nama_pegawai_coach',
            // 'jawatan',
            // 'tarikh_pelantikan',
            // 'tempoh_hak',
            // 'nama_sukan',
            // 'nama_acara',
            // 'nama_atlet',
            // 'status_pilihan',
            // 'nama_jurulatih',

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
