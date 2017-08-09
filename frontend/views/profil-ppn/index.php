<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\UserPeranan;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::profil_ppn;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-ppn']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-ppn']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-ppn']['create'])): ?>
    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::profil_ppn, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'username',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::username,
                ]
            ],
            //'jabatan_id',
            //'peranan',
            //'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            [
                'attribute' => 'full_name',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::full_name,
                ]
            ],
            //'no_kad_pengenalan',
            // 'tel_mobile_no',
            // 'tel_no',
            [
                'attribute' => 'email',
                'format' => 'email',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::email,
                ]
            ],
            // 'status_id',
            [
                'attribute' => 'ppn_negeri',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::negeri,
                ],
                'value' => 'refNegeriPpn.desc',
                'label' => GeneralLabel::negeri,
            ],
            [
                'attribute' => 'aduan_jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ]
            ],
            /*[
                'attribute' => 'urusetia_kategori_program_e_bantuan_desc',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_program,
                ],
                'value' => 'refKategoriProgram.desc',
                'label' => GeneralLabel::kategori_program,
            ],*/

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
                    'update' => function ($url, $model) {
                        $link =  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        ]);
                        
                        if((Yii::$app->user->identity->peranan && Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_PPN &&
                                $model->id == Yii::$app->user->identity->id) || Yii::$app->user->identity->peranan != UserPeranan::PERANAN_MSN_PPN){
                            return $link;
                        } else {
                            return '';
                        }
                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
