<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PsikologiProfil */

$this->title = GeneralLabel::createTitle . ' Profil Psikologi';
$this->params['breadcrumbs'][] = ['label' => 'Profil Psikologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
