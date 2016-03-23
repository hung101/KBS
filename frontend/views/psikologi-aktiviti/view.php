<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiAktiviti */

//$this->title = $model->psikologi_aktiviti_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::aktiviti_psikologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::aktiviti_psikologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-aktiviti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->psikologi_aktiviti_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->psikologi_aktiviti_id], [
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
            'psikologi_aktiviti_id',
            'psikologi_profil_id',
            'nama_aktiviti',
            'tarikh_mula',
            'tarikh_tamat',
        ],
    ]);*/ ?>

</div>
