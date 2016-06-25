<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPemilihan */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anugerah_ahli_jawantankuasa_pemilihan_id',
            'perwakilan',
            'nama',
            'jawatan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
