$(document).ready(function() {



    let usersTable = new DataTable('#usersTable');
    let linksTable = new DataTable('#linksTable');
    let logsTable = new DataTable('#logsTable');

    //if #dashChart exists, create a new chart
    if ($('#dashChart').length) {
        let dashChartCtx = $('#dashChart');

        //create chart labels from totalClicksPerMonth
        let labels = [];
        for (let i = 0; i < totalClicksPerMonth.length; i++) {
            let label = getMonthName(totalClicksPerMonth[i].month) + '/' + totalClicksPerMonth[i].year;
            labels.push(label);
        }

        //create chart data from totalClicksPerMonth
        let data = [];
        for (let i = 0; i < totalClicksPerMonth.length; i++) {
            data.push(totalClicksPerMonth[i].total);
        }

        new Chart(dashChartCtx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: '# of clicks',
                data: data,
                borderWidth: 1
              }]
            },
            options: {
              maintainAspectRatio: false,
              responsive: true,
              scales: {
                y: {
                  beginAtZero: true,
                }
              }
            }
          });

    }

});

function getMonthName(monthNumber) {
    const date = new Date();
    date.setMonth(monthNumber - 1);
  
    return date.toLocaleString('en-US', {
      month: 'long',
    });
  }