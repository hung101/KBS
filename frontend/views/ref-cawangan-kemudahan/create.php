<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefCawangan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::cawangan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cawangan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-cawangan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
