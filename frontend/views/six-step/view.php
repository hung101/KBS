<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\SixStep */

//$this->title = $model->six_step_id;
$this->title = GeneralLabel::viewTitle . ' Six Step';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hpt, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="six-step-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->six_step_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->six_step_id], [
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
            'six_step_id',
            'atlet_id',
            'stage',
            'status',
        ],
    ])*/ ?>

</div>
