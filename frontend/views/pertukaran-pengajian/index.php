<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PertukaranPengajianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pertukaran_pengajian;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pertukaran-pengajian-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['create'])): ?>
        <p>
            <?= Html::a( GeneralLabel::permohonan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pertukaran_pengajian_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'sebab_pemohonan',
            //'kategori_pengajian',
            [
                'attribute' => 'sebab_pemohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sebab_pemohonan,
                ],
                'value' => 'refSebabPermohonanPertukaranPengajian.desc'
            ],
            [
                'attribute' => 'sebab',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' Sebab',
                ],
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanPendidikan.desc'
            ],
            [
                'attribute' => 'tarikh_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_permohonan,
                ],
            ],
            
            /*[
                'attribute' => 'created',
                'label' => GeneralLabel::tarikh,
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->created){
                        return date('Y-m-d',strtotime($model->created));
                    } else {
                        return '';
                    }
                },
            ],*/
            /*[
                'attribute' => 'nama_pengajian_sekarang',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pengajian_sekarang,
                ]
            ],*/
            //'nama_pertukaran_pengajian',
            /*[
                'attribute' => 'nama_pertukaran_pengajian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pertukaran_pengajian,
                ],
                'value' => 'refPengajian.desc'
            ],*/
            // 'sebab_pertukaran',
            // 'sebab_penangguhan',

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
