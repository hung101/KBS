<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanCadanganKertasKerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::permohonan_ebantuan_cadangan_kertas_kerja;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Permohonan e-Bantuan Cadangan Kertas Kerja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_e_bantuan_cadangan_kertas_kerja_id',
            //'permohonan_e_bantuan_id',
            [
                'attribute' => 'nama_cadangan_kertas_kerja',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_cadangan_kertas_kerja,
                ]
            ],
            //'muat_naik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
