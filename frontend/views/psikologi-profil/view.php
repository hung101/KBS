<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiProfil */

//$this->title = $model->psikologi_profil_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_psikologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_psikologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-profil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-profil']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->psikologi_profil_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-profil']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->psikologi_profil_id], [
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
            'psikologi_profil_id',
            'nama',
            'pangkat',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'jantina',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'emel',
            'facebook',
        ],
    ]);*/ ?>

</div>
