<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\TemujanjiKomplimentari */

//$this->title = $model->temujanji_komplimentari_id;
$this->title = GeneralLabel::viewTitle . ' Temujanji Komplimentari';
$this->params['breadcrumbs'][] = ['label' => 'Temujanji Komplimentari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temujanji-komplimentari-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->temujanji_komplimentari_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->temujanji_komplimentari_id], [
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
            'temujanji_komplimentari_id',
            'atlet_id',
            'perkhidmatan',
            'tarikh_khidmat',
            'pegawai_yang_bertanggungjawab',
            'status_temujanji',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
