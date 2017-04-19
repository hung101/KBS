<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPassportTempatDikeluarkan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tempat_passport_dikeluarkan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempat_passport_dikeluarkan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-passport-tempat-dikeluarkan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
