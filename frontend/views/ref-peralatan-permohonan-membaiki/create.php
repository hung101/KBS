<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanPermohonanMembaiki */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peralatan_permohonan_membaiki;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peralatan_permohonan_membaiki, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peralatan-permohonan-membaiki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
