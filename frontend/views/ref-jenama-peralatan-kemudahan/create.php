<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenamaPeralatanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenama_peralatan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenama_peralatan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenama-peralatan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
