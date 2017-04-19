<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKeputusanKpsk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::keputusan." KPSK";
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keputusan." KPSK", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-keputusan-kpsk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
