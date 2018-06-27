<?php session_start();?>
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-chart-pie-36 text-success"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="numbers">
                            <p class="card-category">Today</p>
                            <h4 id="val-usage-today" class="card-title">Loading...</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-refresh"></i> Updated 1min ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-spaceship text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="numbers">
                            <p class="card-category">This month</p>
                            <h4 id="val-usage-month" class="card-title">Loading...</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-refresh"></i> Updated 1min ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-battery-81 text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="numbers">
                            <p class="card-category">Remaining</p>
                            <h4 id="val-remaining-level" class="card-title">Loading...</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-refresh"></i> Updated 1min ago
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Tank's Water</h4>
                <p class="card-category">Last Day results</p>
            </div>
            <div class="card-body ">
                <div id="chartWaterLevel" class="ct-chart ct-perfect-fourth"></div>
            </div>
            <div class="card-footer ">
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Remaining
                    <i class="fa fa-circle text-danger"></i> Used
                </div>
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Updated 1 second ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Water Usage(Daily)</h4>
                <p class="card-category">24 Hours performance</p>
            </div>
            <div class="card-body ">
                <div id="chartDays" class="ct-chart xx"></div>
            </div>
            <div class="card-footer ">
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Usage
                </div>
                <hr>
                <div class="stats">
                    <i class="fa fa-history"></i> Updated 1 second ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Water Usage(Monthly)</h4>
                <p class="card-category">24 Hours performance</p>
            </div>
            <div class="card-body ">
                <div id="chartMonths" class="ct-chart xx"></div>
            </div>
            <div class="card-footer ">
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Usage
                </div>
                <hr>
                <div class="stats">
                    <i class="fa fa-history"></i> Updated 1 second ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Water Usage(Annual)</h4>
                <p class="card-category">24 Hours performance</p>
            </div>
            <div class="card-body ">
                <div id="chartYears" class="ct-chart xx"></div>
            </div>
            <div class="card-footer ">
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Usage
                </div>
                <hr>
                <div class="stats">
                    <i class="fa fa-history"></i> Updated 1 second ago
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    updateCurrentStatus(<?= $_SESSION['deviceId']?>);


</script>