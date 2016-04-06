<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranGym */

//$this->title = $model->pendaftaran_gym_id;
$this->title = GeneralLabel::viewTitle . ' Pendaftaran GYM';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendaftaran_gym, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-gym-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pendaftaran-gym']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pendaftaran_gym_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pendaftaran-gym']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pendaftaran_gym_id], [
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
            'pendaftaran_gym_id',
            'atlet_id',
            'tarikh',
            'sukan',
        ],
    ]);*/ ?>

</div>
