<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKedudukanKejohanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kedudukan_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kedudukan_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kedudukan-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
