<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PerancanganProgram */

//$this->title = $model->perancangan_program_id;
$this->title = GeneralLabel::viewTitle . ' Program';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perancangan-program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->perancangan_program_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->perancangan_program_id], [
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
            'perancangan_program_id',
            'tarikh',
            'nama_program',
            'muat_naik',
        ],
    ]);*/ ?>

</div>
