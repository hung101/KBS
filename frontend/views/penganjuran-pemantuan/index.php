<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenganjuranPemantuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penganjuran Pemantuans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-pemantuan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penganjuran Pemantuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'penganjuran_pemantuan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penganjuran_pemantuan_id,
                ]
            ],
            [
                'attribute' => 'permohonan_pendahuluan_pelagai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::permohonan_pendahuluan_pelagai,
                ]
            ],
            [
                'attribute' => 'menghantar_surat_cuti_tanpa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::menghantar_surat_cuti_tanpa,
                ]
            ],
            [
                'attribute' => 'keperluan_bengkel_telah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::keperluan_bengkel_telah,
                ]
            ],
            [
                'attribute' => 'membuat_tempahan_penginapan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::membuat_tempahan_penginapan,
                ]
            ],
            // 'membuat_tempahan_tempat_untuk',
            // 'mengesahan_kehadiran_panel',
            // 'mengesahan_pendaftaran_panel',
            // 'memberi_taklimat',
            // 'mengumpul_dan_membukukan',
            // 'membuat_pelarasan_kewangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
