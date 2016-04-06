<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanBiomekanik */

$this->title = GeneralLabel::createTitle.' '.'Ref Perkhidmatan Biomekanik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Biomekaniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-biomekanik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
