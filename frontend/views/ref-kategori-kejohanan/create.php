<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgama */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agama-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
