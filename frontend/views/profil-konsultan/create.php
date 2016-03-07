<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilKonsultan */

$this->title = GeneralLabel::createTitle . ' Profil Kaunselor';
$this->params['breadcrumbs'][] = ['label' => 'Profil Kaunselor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-konsultan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
