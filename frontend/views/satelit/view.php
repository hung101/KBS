<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Satelit */

//$this->title = $model->satelit_id;
$this->title = GeneralLabel::viewTitle . ' Satelit';
$this->params['breadcrumbs'][] = ['label' => 'Satelit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satelit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['satelit']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->satelit_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['satelit']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->satelit_id], [
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
            'satelit_id',
            'atlet_id',
            'tarikh',
            'sukan',
            'perkhidmatan',
            'fasiliti',
        ],
    ]);*/ ?>

</div>
