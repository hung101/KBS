<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPelantikanSueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Permohonan Pelantikan Sues';
$this->title = GeneralLabel::permohonan_pelantikan_sue;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pelantikan-sue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Permohonan Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_pelantikan_sue_id',
            'nama_sue',
            //'no_kad_pengenalan',
            //'emel',
            //'jumlah_dipohon',
            'nama_persatuan',
            // 'tarikh_mula_khidmat',
            // 'sehingga',
            // 'muatnaik',
            'status_permohonan',
            // 'catatan',
            'tarikh_dipohon',
            // 'jumlah_diluluskan',
            // 'tarikh_kelulusan_jkb',
            // 'bilangan_jkb',
            // 'tarikh_lantikan',
            // 'tarikh_tamat_lantikan',
            // 'tempoh',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
