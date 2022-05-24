<style>
    .chartjs-render-monitor {
        max-width: 100%;
    }

    .chartjs-legend ul {
        list-style: none;
        padding-left: 0;
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .chartjs-legend ul li {
        margin-right: 8%;
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
    }

    .chartjs-legend ul li span {
        height: 20px;
        width: 20px;
        margin-right: 1rem;
        display: inline-block;
        font-size: 0.875rem;
    }

    .rtl .chartjs-legend ul {
        padding-right: 0;
    }

    .rtl .chartjs-legend ul li {
        margin-right: 0;
        margin-left: 8%;
    }

    .rtl .chartjs-legend ul li span {
        margin-right: 0;
        margin-left: 1rem;
    }

    .chartjs-render-monitor {
        max-width: 100%;
    }
</style>

@push('after-scripts')
<script>
    $(function() {
    if ($("#earning-report-chart").length) {
      var earningReportData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        datasets: [{
          label: '# of Votes',
          data: [17, 85, 32, 25, 12, 33],
          backgroundColor: [
            'rgba(7, 102, 198, 1)',
            'rgba(0, 178, 151, 1)',
            'rgba(7, 102, 198, 1)',
            'rgba(0, 178, 151, 1)',
            'rgba(7, 102, 198, 1)',
            'rgba(0, 178, 151, 1)',
          ],
          borderWidth: 0
        }]
      };
      var earningReportOptions = {
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          xAxes: [{
            gridLines: {
              color: '#f3f6f9'
            },
            ticks: {
              display: false,
              min: 0,
              max: 100,
              stepSize: 20
            }
          }],
          yAxes: [{
            gridLines: {
              color: '#f3f6f9'             
            },
            ticks: {
              display: true,
              min: 0,
              max: 100,
              stepSize: 50
            }
          }]
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 0
          }
        },
        layout: {
          padding: {
            top: 0,
            bottom: 0
          }
        },
    
      };
      var earningReportChartCanvas = $("#earning-report-chart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var barChart = new Chart(earningReportChartCanvas, {
        type: 'horizontalBar',
        data: earningReportData,
        options: earningReportOptions
      });
    }
});
</script>
@endpush

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
<h4 class="card-title">Earning report</h4>
<p class="text-muted font-weight-light">Past 30 Days — Last Updated Oct 14, 2017</p>
<canvas id="earning-report-chart" style="display: block; width: 393px; height: 196px;" width="393" height="196"
    class="chartjs-render-monitor"></canvas>