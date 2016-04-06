<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSektorPekerjaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sektor_pekerjaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sektor_pekerjaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sektor-pekerjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
