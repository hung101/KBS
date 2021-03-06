<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\UserPeranan */

//$this->title = $model->user_peranan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::user_peranan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::admin_user_peranan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-peranan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->user_peranan_id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo Html::a(GeneralLabel::delete, ['delete', 'id' => $model->user_peranan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_peranan_id',
            'nama_peranan',
            'peranan_akses',
            //'aktif',
            [
                'attribute' => 'aktif',
                'value' => $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no,
            ],        ],
    ]);*/ ?>

</div>
