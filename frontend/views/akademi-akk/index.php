<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AkademiAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::akademi_kejurulatihan_kebangsaan_akk;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akademi-akk-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'akademi_akk_id',
            //'nama',
            [
                'attribute' => 'nama',
                'value' => 'refJurulatih.nama'
            ],
            //'muatnaik_gambar',
            'no_kad_pengenalan',
            //'no_passport',
            // 'tarikh_lahir',
            // 'tempat_lahir',
            // 'no_telefon',
            // 'emel',
            // 'nama_majikan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',
            // 'no_telefon_pejabat',
            //'kategori_pensijilan',
            [
                'attribute' => 'kategori_pensijilan',
                'value' => 'refKategoriPensijilanAkademiAkk.desc'
            ],
            'jenis_sukan',
            'tahun',

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
