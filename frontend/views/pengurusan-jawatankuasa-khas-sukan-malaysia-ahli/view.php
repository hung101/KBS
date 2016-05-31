<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli */

$this->title = $model->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jawatankuasa Khas Sukan Malaysia Ahlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-ahli-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id], [
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
            'pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id',
            'jenis_keahlian',
            'jenis_keahlian_nyatakan',
            'nama',
            'jawatan',
            'agensi_organisasi',
            'agensi_organisasi_nyatakan',
            'negeri',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
