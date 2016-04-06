<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTemujanjiFisioterapi */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Temujanji Fisioterapi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Temujanji Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-temujanji-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
