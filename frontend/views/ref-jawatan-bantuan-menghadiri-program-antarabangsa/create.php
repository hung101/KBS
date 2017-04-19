<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanBantuanMenghadiriProgramAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-bantuan-menghadiri-program-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
