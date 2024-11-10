Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById("myBarChart");
    if (ctx) {
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyLabels, // Use dynamic labels passed from the controller
                datasets: [{
                    label: "Monthly Revenue",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: monthlyRevenues, // Use dynamic data passed from the controller
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: Math.max(...monthlyRevenues) + 1000, // Set max dynamically
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    }
});
