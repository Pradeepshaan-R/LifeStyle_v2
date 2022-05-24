@push('after-scripts')
<script>
    $(function() {
    if ($("#issues-chart").length) {
      var issuesChartData = {
        datasets: [{
          data: [60, 30, 10],
          backgroundColor: [
            '#f3f6f9',
            '#0766c6',
            '#00b297'
          ],
          borderWidth: 0
        }],
    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'Closed',
          'In progress',
          'Open'
        ]
      };
      var issuesChartOptions = {
        responsive: true,
        maintainAspectRatio: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        legend: {
          display: false
        },
        legendCallback: function(chart) { 
          var text = [];
          text.push('<ul class="legend'+ chart.id +'">');
          for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
            text.push('<li><span class="legend-label" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '"></span>');
            if (chart.data.labels[i]) {
              text.push(chart.data.labels[i]);
            }
            text.push('<span class="legend-percentage ml-auto">'+ chart.data.datasets[0].data[i] + '%</span>');
            text.push('</li>');
          }
          text.push('</ul>');
          return text.join("");
        },
        cutoutPercentage: 70     
      };
      var issuesChartCanvas = $("#issues-chart").get(0).getContext("2d");
      var issuesChart = new Chart(issuesChartCanvas, {
        type: 'doughnut',
        data: issuesChartData,
        options: issuesChartOptions
      });
      document.getElementById('issues-chart-legend').innerHTML = issuesChart.generateLegend();
    }
});
</script>
@endpush

<h4 class="card-title">Issue rate</h4>
<aside class="row">
    <div class="col-md-5 d-flex align-items-center pr-4">
        <div class="chartjs-size-monitor"
            style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand"
                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink"
                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
        </div>
        <canvas id="issues-chart" width="138" height="138" class="chartjs-render-monitor"
            style="display: block; width: 138px; height: 138px;"></canvas>
    </div>
    <div class="col-md-7">
        <div class="border-bottom pb-4 mt-2 mt-md-0">
            <h1 class="text-center text-md-left">12,456</h1>
            <p class="text-center text-md-left mb-0">Issues this Month</p>
        </div>
        <div class="pt-4">
            <div id="issues-chart-legend" class="issues-chart-legend">
                <ul class="legend1">
                    <li><span class="legend-label" style="background-color:#f3f6f9"></span>Closed<span
                            class="legend-percentage ml-auto">60%</span></li>
                    <li><span class="legend-label" style="background-color:#0766c6"></span>In progress<span
                            class="legend-percentage ml-auto">30%</span></li>
                    <li><span class="legend-label" style="background-color:#00b297"></span>Open<span
                            class="legend-percentage ml-auto">10%</span></li>
                </ul>
            </div>
        </div>
    </div>
</aside>