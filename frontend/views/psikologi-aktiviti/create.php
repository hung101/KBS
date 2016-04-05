<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PsikologiAktiviti */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::aktiviti_psikologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::aktiviti_psikologi, 'url' => ['index', 'psikologi_profil_id' => $psikologi_profil_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-aktiviti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
