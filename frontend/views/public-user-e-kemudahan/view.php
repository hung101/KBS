<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\User */

//$this->title = $model->id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::e_kemudahan_public_user;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::e_kemudahan_public_user, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->username != "admin"): ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'jabatan_id',
            'peranan',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'full_name',
            'tel_mobile_no',
            'tel_no',
            'email:email',
            'status',
            'created_at',
            'updated_at',
        ],
    ]);*/ ?>

</div>
