<?php
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'KEMENTERIAN BELIA DAN SUKAN MALAYSIA - Dashboard';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Selamat Datang</h1>

        <p class="lead">SISTEM PENGURUSAN SUKAN BERSEPADU TEST</p>

        <!--<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <!--<h2>Bajet 2015</h2>-->

                <?php
                    echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Bajet 2015'],
        'plotOptions' => [
            'pie' => [
                'cursor' => 'pointer',
            ],
        ],
        'series' => [
            [ // new opening bracket
                'type' => 'pie',
                'name' => 'Elements',
                'data' => [
                    ['Baki - RM845,600', 45.0],
                    ['Perubatan - RM313,400', 26.8],
                    ['Elaun - RM165,600', 8.5],
                    ['Insentif - RM115,100', 6.2],
                    ['Lain-lain - RM35,900', 0.7]
                ],
            ] // new closing bracket
        ],
    ],
]);
                ?>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Lihat &raquo;</a></p>
            </div>
            <div class="col-lg-6">
                <!--<h2>Prestasi Atlet</h2>-->

                <?php
                    echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Prestasi Atlet 2015'],
        'plotOptions' => [
            'pie' => [
                'cursor' => 'pointer',
            ],
        ],
        'series' => [
            [ // new opening bracket
                'type' => 'pie',
                'name' => 'Elements',
                'data' => [
                    ['Mohamad Ahli - 35 Pingat', 35.0],
                    ['Josep Akmar - 25 Pingat', 25.0],
                    ['Johnson - 15 Pingat', 15.0],
                    ['Lee Kim Wei - 10 Pingat', 10],
                    ['Kimberly - 5 Pingat', 5]
                ],
            ] // new closing bracket
        ],
    ],
]);
                ?>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Lihat &raquo;</a></p>
            </div>
            <!--<div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>-->
        </div>

    </div>
</div>
