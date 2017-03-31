<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ForumSeminarPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forum Seminar Pesertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Forum Seminar Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'forum_seminar_peserta_id',
            'forum_seminar_persidangan_di_luar_negara_id',
            'session_id',
            'nama',
            'jawatan',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
