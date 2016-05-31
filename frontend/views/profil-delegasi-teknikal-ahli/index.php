<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfilDelegasiTeknikalAhliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil Delegasi Teknikal Ahlis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-delegasi-teknikal-ahli-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profil Delegasi Teknikal Ahli', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'profil_delegasi_teknikal_ahli_id',
            'profil_delegasi_teknikal_id',
            'nama',
            'no_kad_pengenalan',
            'jantina',
            // 'tarikh_lahir',
            // 'umur',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'jawatan',
            // 'no_telefon_bimbit',
            // 'emel',
            // 'pekerjaan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',
            // 'no_telefon_pejabat',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
