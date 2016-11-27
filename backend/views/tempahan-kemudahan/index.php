<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use backend\models\SignupEKemudahanForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TempahanKemudahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::tempahan;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-index">
    
    <?php
        if(\Yii::$app->user->identity->jenis_pengguna_e_kemudahan == SignupEKemudahanForm::PENGGUNA){
            $template = '{view}';
        } else {
            $template = '{view} {update}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(\Yii::$app->user->identity->jenis_pengguna_e_kemudahan == SignupEKemudahanForm::PENGGUNA):?>
        <p>
            <?= Html::a(GeneralLabel::tempahan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif;?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tempahan_kemudahan_id',
            //'nama',
            //'no_kad_pengenalan',
            //'location_alamat_1',
            //'venue',
            [
                'attribute' => 'venue',
                'value' => 'refPengurusanKemudahanVenue.nama_venue'
            ],
            //'tarikh_mula',
            [
                'attribute' => 'tarikh_mula',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'jenis_kadar',
                'value' => 'refJenisKadarKemudahan.desc'
            ],
            'quantity_kadar',
            'bayaran_sewa',
            [
                'attribute' => 'status',
                'value' => 'refStatusTempahanKemudahan.desc'
            ],
            //'tarikh_akhir',
            // 'catatan',

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
        
        <!--<?= Html::a('Kembali', ['site/e-kemudahan-home'], ['class' => 'btn btn-warning']) ?>-->

</div>
