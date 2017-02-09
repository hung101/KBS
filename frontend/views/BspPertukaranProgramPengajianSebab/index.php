<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPertukaranProgramPengajianSebabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sebab Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-sebab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Sebab Pertukaran Program Pengajian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pertukaran_program_pengajian_sebab_id',
            //'bsp_pertukaran_program_pengajian_id',
            'sebab',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
