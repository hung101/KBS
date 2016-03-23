<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilWartawanSukan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::profil_wartawan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_wartawan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-wartawan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
