<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PenyelidikanKomposisiPasukan */

$this->title = $model->penyelidikan_komposisi_pasukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Penyelidikan Komposisi Pasukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyelidikan-komposisi-pasukan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->penyelidikan_komposisi_pasukan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->penyelidikan_komposisi_pasukan_id], [
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
            'penyelidikan_komposisi_pasukan_id',
            'permohonana_penyelidikan_id',
            'nama',
            'pasukan',
            'jawatan',
            'telefon_no',
            'emel',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'institusi_universiti_syarikat',
        ],
    ]);*/ ?>

</div>
