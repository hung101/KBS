<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPerganjuranInstructorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instruktur';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perganjuran-instructor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Instruktur', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_perganjuran_instructor_id',
            //'permohonan_perganjuran_id',
            'nama_instructor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
