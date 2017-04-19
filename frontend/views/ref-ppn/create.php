<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPpn */

$this->title = GeneralLabel::createTitle.' PPN';
$this->params['breadcrumbs'][] = ['label' => 'PPN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ppn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
