<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SenaraiJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_jurulatih_id',
            //'pengurusan_jkk_jkp_program_id',
            'jurulatih',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
