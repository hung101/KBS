<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MesyuaratSenaraiTugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mesyuarat - Senarai Tugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-senarai-tugas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Mesyuarat - Senarai Tugas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_tugas_id',
            //'mesyuarat_id',
            'name_tugas',
            'tarikh_tamat',
            'pegawai',
            'atlet_id',
            // 'persatuan',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
