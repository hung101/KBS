<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */

//$this->title = $model->tempahan_kemudahan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::tempahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['update']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->tempahan_kemudahan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['delete']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->tempahan_kemudahan_id], [
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
            'tempahan_kemudahan_id',
            'nama',
            'no_kad_pengenalan',
            'location_alamat_1',
            'venue',
            'tarikh',
            'catatan',
        ],
    ]);*/ ?>

</div>
