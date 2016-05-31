<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPanelPenasihatKpsk */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::profil_panel_penasihat_kpsk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_panel_penasihat_kpsk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-panel-penasihat-kpsk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
