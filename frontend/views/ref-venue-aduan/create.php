<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefVenueAduan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tempat_aduan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempat_aduan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-venue-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
