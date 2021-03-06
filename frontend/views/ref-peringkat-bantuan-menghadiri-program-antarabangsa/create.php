<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanMenghadiriProgramAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat_bantuan_menghadiri_program_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat_bantuan_menghadiri_program_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-menghadiri-program-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
