<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanProgramBinaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_program_binaan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::permohonan_baru, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_program_binaan_id',
            //'nama_ppn',
            //'pengurus_pn',
            //'kategori_permohonan',
            /*[
                'attribute' => 'kategori_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_permohonan,
                ],
                'value' => 'refKategoriPermohonan.desc'
            ],*/
            //'jenis_permohonan',
            /*[
                'attribute' => 'jenis_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_permohonan,
                ],
                'value' => 'refJenisPermohonan.desc'
            ],*/
            // 'sukan',
            // 'tempat',
            // 'tahap',
            // 'negeri',
            // 'daerah',
            /*[
                'attribute' => 'aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktiviti,
                ],
                'value' => 'refPerancanganProgram.nama_program'
            ],*/
            [
                'attribute' => 'nama_aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_aktiviti,
                ]
            ],
             [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula);
                },
            ],
             [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat);
                },
            ],
            // 'sokongan_pn',
            /*[
                'attribute' => 'sokongan_pn',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sokongan_pn,
                ],
                'value' => 'refSokongPn.desc'
            ],*/
            //'kelulusan',
            /*[
                'attribute' => 'kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelulusan,
                ],
                'value' => 'refKelulusanProgramBinaan.desc'
            ],*/
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanProgramBinaan.desc'
            ],
            [
                'attribute' => 'jumlah_yang_diluluskan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_yang_diluluskan,
                ],
            ],

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
