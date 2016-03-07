<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PertukaranPengajianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pertukaran Pengajian';
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
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Pertukaran Pengajian', ['create'], ['class' => 'btn btn-success']) ?>
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
                'value' => 'refAtlet.name_penuh'
            ],
            //'sebab_pemohonan',
            //'kategori_pengajian',
            'nama_pengajian_sekarang',
            //'nama_pertukaran_pengajian',
            [
                'attribute' => 'nama_pertukaran_pengajian',
                'value' => 'refPengajian.desc'
            ],
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
