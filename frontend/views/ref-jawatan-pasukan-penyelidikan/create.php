<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPasukanPenyelidikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatan_pasukan_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatan_pasukan_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-pasukan-penyelidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
