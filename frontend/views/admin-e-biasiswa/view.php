<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AdminEBiasiswa */

//$this->title = $model->admin_e_biasiswa_id;
$this->title = GeneralLabel::viewTitle . ' Admin : E-Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Admin : E-Biasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-ebiasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->admin_e_biasiswa_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->admin_e_biasiswa_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'admin_e_biasiswa_id',
            'nama',
            'tarikh_mula',
            'tarikh_tamat',
            //'aktif',
            [
                'attribute' => 'aktif',
                'value' => $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no,
            ],
        ],
    ]);*/ ?>

</div>
