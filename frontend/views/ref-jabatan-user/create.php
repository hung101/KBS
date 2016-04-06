<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJabatanUser */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jabatan_user;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jabatan_user, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jabatan-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
