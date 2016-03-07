<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukan */

$this->title = 'Profil Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Profil Badan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="profil-badan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
