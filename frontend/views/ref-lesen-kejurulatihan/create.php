<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLesenKejurulatihan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::lesen_kejurulatihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lesen_kejurulatihan_msn, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lesen-kejurulatihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
