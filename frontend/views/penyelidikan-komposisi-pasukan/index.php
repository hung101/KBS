<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenyelidikanKomposisiPasukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyelidikan Komposisi Pasukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyelidikan-komposisi-pasukan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penyelidikan Komposisi Pasukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyelidikan_komposisi_pasukan_id',
            //'permohonana_penyelidikan_id',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'pasukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pasukan,
                ]
            ],
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ]
            ],
            // 'telefon_no',
            // 'emel',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'institusi_universiti_syarikat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
