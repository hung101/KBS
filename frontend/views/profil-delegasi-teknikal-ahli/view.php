<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilDelegasiTeknikalAhli */

$this->title = $model->profil_delegasi_teknikal_id;
$this->params['breadcrumbs'][] = ['label' => 'Profil Delegasi Teknikal Ahlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-delegasi-teknikal-ahli-view">

    <!--<<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->profil_delegasi_teknikal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->profil_delegasi_teknikal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profil_delegasi_teknikal_ahli_id',
            'profil_delegasi_teknikal_id',
            'nama',
            'no_kad_pengenalan',
            'jantina',
            'tarikh_lahir',
            'umur',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'jawatan',
            'no_telefon_bimbit',
            'emel',
            'pekerjaan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
            'no_telefon_pejabat',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ])*/ ?>

</div>
