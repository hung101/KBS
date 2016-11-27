<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_terdahulu;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-index">
    
    <?php
        $template = '{view} {update}';
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a(GeneralLabel::permohonan_baru, ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_e_bantuan_id',
            'ebantuan_id',
            //'no_pendaftaran',
            //'nama_pertubuhan_persatuan',
            //'tarikh_didaftarkan',
            /*[
                'attribute' => 'tarikh_didaftarkan',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_didaftarkan);
                },
            ],*/
            //'pejabat_yang_mendaftarkan',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'no_telefon_pejabat',
            // 'no_telefon_bimbit',
            // 'no_fax',
            // 'email:email',
            // 'bilangan_keahlian',
            // 'bilangan_cawangan_badan_gabungan',
            // 'objektif_pertubuhan',
            // 'aktiviti_dan_kejayaan_yang_dicapai',
            'nama_program',
            //'jumlah_bantuan_yang_dipohon',
            [
                'attribute' => 'jumlah_bantuan_yang_dipohon',
                'label' => 'Jumlah Bantuan Yang Dipohon'
            ],
            //'kelulusan',
            /*[
                'attribute' => 'kelulusan',
                'value' => 'refKelulusan.desc'
            ],*/
            //'bil_mesyuarat',
            //'tarikh_mesyuarat',
            'jumlah_diluluskan',
            [
                'attribute' => 'status_permohonan',
                'value' => 'refStatusPermohonanEBantuan.desc'
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
        
        <!--<?= Html::a('Kembali', ['site/e-bantuan-home'], ['class' => 'btn btn-warning']) ?>-->

</div>
