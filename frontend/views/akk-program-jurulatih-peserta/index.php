<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AkkProgramJurulatihPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akk Program Jurulatih Pesertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akk Program Jurulatih Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'akk_program_jurulatih_peserta_id',
            'akk_program_jurulatih_id',
            'jurulatih',
            'sukan',
            'acara',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
