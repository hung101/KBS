<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pemantauan_jurulatih;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-pemantauan-jurulatih-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['laporan-pemantauan-jurulatih']['update'])){
            //$template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['laporan-pemantauan-jurulatih']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['laporan-pemantauan-jurulatih']['create']) && $jurulatih_id==null): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::pemantauan_jurulatih, ['create', 'jurulatih_id' => $jurulatih_id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'jurulatih_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jurulatih,
                ],
                'value' => 'refJurulatih.nama'
            ],
            [
                'attribute' => 'sukan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'program_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgram.desc'
            ],
            [
                'attribute' => 'pusat_latihan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pusat_latihan,
                ],
            ],
            [
                'attribute' => 'tarikh_dinilai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_dinilai,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_dinilai);
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);
                    },
                    'view' => function ($url, $model) use ($jurulatih_id){
                        if($jurulatih_id != null){
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url.'&jurulatih_id='.$jurulatih_id, [
                            'title' => Yii::t('yii', 'View'),
                            ]);
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            ]);
                        }
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
