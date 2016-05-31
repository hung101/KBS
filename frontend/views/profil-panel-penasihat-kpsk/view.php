<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPanelPenasihatKpsk */

//$this->title = $model->profil_panel_penasihat_kpsk_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_panel_penasihat_kpsk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_panel_penasihat_kpsk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-panel-penasihat-kpsk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-panel-penasihat-kpsk']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->profil_panel_penasihat_kpsk_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-panel-penasihat-kpsk']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->profil_panel_penasihat_kpsk_id], [
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
            'profil_panel_penasihat_kpsk_id',
            'nama',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'jantina',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'emel',
            'tahap_akademik',
            'nama_jurusan',
            'pengkhususan',
            'silibus',
            'nama_majikan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
            'no_telefon_majikan',
            'no_faks',
            'jawatan',
            'gred',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
