<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangProfilPesertaKpskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::borang_profil_peserta_kpsk;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['create'])): ?>
    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::borang_profil_peserta_kpsk, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_profil_peserta_kpsk_id',
            //'penganjur_kursus',
            [
                'attribute' => 'penganjur_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penganjur_kursus,
                ]
            ],
            //'kod_kursus',
            [
                'attribute' => 'kod_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kod_kursus,
                ]
            ],
            //'tarikh_kursus',
            [
                'attribute' => 'tarikh_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_kursus,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_kursus, GeneralFunction::TYPE_DATE);
                },
            ],
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

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
