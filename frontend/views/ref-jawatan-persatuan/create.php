<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPersatuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatan_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatan_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
