<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatankuasaKhas */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatankuasa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatankuasa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatankuasa-khas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
