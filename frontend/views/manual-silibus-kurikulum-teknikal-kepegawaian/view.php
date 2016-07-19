<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ManualSilibusKurikulumTeknikalKepegawaian */

$this->title = GeneralLabel::viewTitle  . ' ' . GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manual-silibus-kurikulum-teknikal-kepegawaian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['manual-silibus-kurikulum-teknikal-kepegawaian']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['manual-silibus-kurikulum-teknikal-kepegawaian']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id], [
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
            'manual_silibus_kurikulum_teknikal_kepegawaian_id',
            'persatuan_sukan',
            'jilid_versi',
            'tarikh',
            'muat_naik',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
