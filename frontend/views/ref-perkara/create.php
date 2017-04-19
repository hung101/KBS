<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPerkara */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::perkara;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
