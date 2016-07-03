<?php
use miloschuman\highcharts\Highcharts;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
$this->title = GeneralLabel::kementerian_belia_dan_sukan_malaysia_dashboard;
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1><?= GeneralMessage::selamat_datang ?></h1>

        <p class="lead"><?= GeneralMessage::sistem_pengurusan_sukan_bersepadu ?></p>
    </div>-->

    <div class="body-content">
        <?php echo Yii::$app->formatter->asDatetime(date('Y-d-m h:i:s'));?>
        <h1>
        Dashboard
        <small><?= GeneralMessage::sistem_pengurusan_sukan_bersepadu ?></small>
      </h1>

        <div class="row">
        
        
            <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>14</h3>

              <p>Atlet</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bicycle"></i>
            </div>
            <a href="#" class="small-box-footer">Maklumat lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <!--<h3>4<sup style="font-size: 20px">%</sup></h3>-->
                <h3>4</h3>

              <p>Jurulatih</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="#" class="small-box-footer">Maklumat lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>28</h3>

              <p>Pengguna Dalaman</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-color-filter"></i>
            </div>
            <a href="#" class="small-box-footer">Maklumat lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>33</h3>

              <p>Pengguna Awam</p>
            </div>
            <div class="icon">
              <i class="ion ion-earth"></i>
            </div>
            <a href="#" class="small-box-footer">Maklumat lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Program</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Jantina</a></li>
              <li class="pull-left header"><i class="fa fa-pie-chart"></i> Atlet & Jurulatih</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                  <div class="row">
                      <div class="col-lg-6">
                          <?php
                            echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'Atlet'],
                                        'plotOptions' => [
                                            'pie' => [
                                                'cursor' => 'pointer',
                                            ],
                                        ],
                                        'series' => [
                                            [ // new opening bracket
                                                'type' => 'pie',
                                                'name' => 'Peratus',
                                                'data' => [
                                                    ['Senior - 1', 7.14],
                                                    ['Pelapis Kebangsaan - 3', 21.42],
                                                    ['Pelapis Serantau - 5', 35.71],
                                                    ['Pelapis Negeri - 4', 28.57],
                                                    ['Bakat - 1', 7.14]
                                                ],
                                            ] // new closing bracket
                                        ],
                                    ],
                                ]);
                            ?>
                      </div>
                      <div class="col-lg-6">
                          <?php
                            echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'Jurulatih'],
                                        'plotOptions' => [
                                            'pie' => [
                                                'cursor' => 'pointer',
                                            ],
                                        ],
                                        'series' => [
                                            [ // new opening bracket
                                                'type' => 'pie',
                                                'name' => 'Peratus',
                                                'data' => [
                                                    ['Senior - 1', 25],
                                                    ['Pelapis Kebangsaan - 1', 25],
                                                    ['Pelapis Serantau - 1', 25],
                                                    ['Pelapis Negeri - 1', 25],
                                                ],
                                            ] // new closing bracket
                                        ],
                                    ],
                                ]);
                            ?>
                      </div>
                  </div>
              </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                  <div class="row">
                      <div class="col-lg-6">
                          <?php
                            echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'Atlet'],
                                        'plotOptions' => [
                                            'pie' => [
                                                'cursor' => 'pointer',
                                            ],
                                        ],
                                        'series' => [
                                            [ // new opening bracket
                                                'type' => 'pie',
                                                'name' => 'Peratus',
                                                'data' => [
                                                    ['LELAKI - 10', 71.14],
                                                    ['PEREMPUAN - 4', 28.86],
                                                ],
                                            ] // new closing bracket
                                        ],
                                        'colors' => [
                                            '#3c8dbc',
                                            '#f56954',
                                        ]
                                    ],
                                ]);
                            ?>
                      </div>
                      <div class="col-lg-6">
                          <?php
                            echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'Jurulatih'],
                                        'plotOptions' => [
                                            'pie' => [
                                                'cursor' => 'pointer',
                                            ],
                                        ],
                                        'series' => [
                                            [ // new opening bracket
                                                'type' => 'pie',
                                                'name' => 'Peratus',
                                                'data' => [
                                                    ['LELAKI - 3', 75],
                                                    ['PEREMPUAN - 1', 25],
                                                ],
                                            ] // new closing bracket
                                        ],
                                        'colors' => [
                                            '#3c8dbc',
                                            '#f56954',
                                        ]
                                    ],
                                ]);
                            ?>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
          
          
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Perbandingan: Apr 2016 - Mei 2016</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    
<?php echo ChartJs::widget([
    'type' => 'Line',
    'clientOptions' => [
        'multiTooltipTemplate' => "<%= datasetLabel %> - <%= value %>",
    ],
    'options' => [
        'height' => 100,
        'id'=>'chartPerbandingan',
    ],
    'data' => [
        'labels' => ["Permohonan", "Cadangan", "Kelulusan", "Perbelanjaan"],
        'datasets' => [
            [
                'label' =>  "April",
                'fillColor' => "rgba(220,220,220,0.5)",
                'strokeColor' => "rgba(220,220,220,1)",
                'pointColor' => "rgba(220,220,220,1)",
                'pointStrokeColor' => "#fff",
                'data' => [286653.16, 292070.00, 236187.30, 247794.58]
            ],
            [
                'label' =>  "Mei",
                'fillColor' => "rgba(151,187,205,0.5)",
                'strokeColor' => "rgba(151,187,205,1)",
                'pointColor' => "rgba(151,187,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => [345365.25, 301103.10, 295234.12, 288133.23]
            ]
        ]
    ],
]);
?>
                    <div id="chartLegend_chartPerbandingan" class="chart-legend"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Jumlah Kelulusan Mengikut Program</strong>
                  </p>
                  <div class="progress-group">
                    <span class="progress-text">Senior</span>
                    <span class="progress-number"><b>RM 50,400.10</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 17%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Pelapis Kebangsaan</span>
                    <span class="progress-number"><b>RM 43,133.15</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 15%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Pelapis Serantau</span>
                    <span class="progress-number"><b>RM 78,167.01</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 27%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Pelapis Negeri</span>
                    <span class="progress-number"><b>RM 47,300.20</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 16%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Bakat</span>
                    <span class="progress-number"><b>RM 76,233.66</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-purple" style="width: 25%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">RM 345,365.25</h5>
                    <span class="description-text">JUMLAH PERMOHONAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 3%</span>
                    <h5 class="description-header">RM 301,103.10</h5>
                    <span class="description-text">JUMLAH CADANGAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">RM 295,234.12</h5>
                    <span class="description-text">JUMLAH KELULUSAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 14%</span>
                    <h5 class="description-header">RM 288,133.23</h5>
                    <span class="description-text">JUMLAH PERBELANJAAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
          

        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
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
