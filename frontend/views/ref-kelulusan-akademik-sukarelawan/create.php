<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanAkademikSukarelawan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_akademik_sukarelawan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_akademik_sukarelawan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-akademik-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
