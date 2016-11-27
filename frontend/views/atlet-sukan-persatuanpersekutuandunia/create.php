<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukanPersatuanpersekutuandunia */

$this->title = GeneralLabel::createTitle . ' '. GeneralLabel::persatuanpersekutuan_dunia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::persatuanpersekutuan_dunia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-persatuanpersekutuandunia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
