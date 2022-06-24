
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Link</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo number_format($stats['link'], 0);?></h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Total link in system.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Visitors</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo number_format($stats['visitors'], 0);?></h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Total visitor.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Visitor last 7 day.</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Browser Usage</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie"></canvas>
                                </div>
                            </div>

                            <table class="table mb-0">
                                <tbody>
                                    <?php 
                                    $chart_browser = [
                                        'label' => [],
                                        'val' => []
                                    ];
                                    foreach($stats['browsers'] as $browser) : 
                                        array_push($chart_browser['label'], $browser['name']);
                                        array_push($chart_browser['val'], $browser['cnt']);
                                    ?>
                                    <tr>
                                        <td><?php echo $browser['name'];?></td>
                                        <td class="text-end"><?php echo $browser['cnt'];?></td>
                                    </tr>
                                    <?php ;endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
 
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Top 10 Short.</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th style="width: 60%;">Link</th>
                                <th class="d-none d-xl-table-cell">Created Date</th>
                                <th class="d-none d-md-table-cell">Creator</th>
                                <th class="text-end">Visitors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($stats['top10_links'] as $link) : ?>
                            <tr>
                                <td>
                                    <strong><?php echo base_url($link['link_key']);?></strong>
                                    <!-- <br />Link to: <?php echo $link['destination_link'];?> -->
                                    <?php 
                                    if($link['remark'] != '') {
                                        echo '<br />Remark: '.$link['remark'];
                                    }
                                    ?>
                                </td>
                                <td class="d-none d-xl-table-cell"><?php echo explode(" ", $link['created_at'])[0];?></td>
                                <td><?php echo $link['creator'];?></td>
                                <td class="d-none d-md-table-cell text-end"><?php echo $link['total_visitors'];?></td>
                            </tr>
                            <?php ;endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: [`<?php echo implode('`, `', $stats['visitors_in_7days']['label']);?>`],
					datasets: [{
						label: "Visitors",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [ <?php echo implode(', ', $stats['visitors_in_7days']['val']);?> ]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>

<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: [`<?php echo implode('`, `', $chart_browser['label']);?>`],
					datasets: [{
						data: [<?php echo implode(', ', $chart_browser['val']);?>],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
                            window.theme.primary,
							window.theme.warning,
							window.theme.danger,
                            window.theme.primary,
							window.theme.warning,
							window.theme.danger,
                            window.theme.primary,
							window.theme.warning,
							window.theme.danger,
                            window.theme.primary,
							window.theme.warning,
							window.theme.danger,
                            window.theme.primary,
							window.theme.warning,
							window.theme.danger,
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>