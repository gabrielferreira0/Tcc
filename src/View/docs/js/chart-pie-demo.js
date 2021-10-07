// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


// data: {
//   labels: ["Direct", "Referral", "Social"],
//       datasets: [{
//     data: [55, 30, 15],
//     backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
//     hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
//     hoverBorderColor: "rgba(234, 236, 244, 1)",
//   }],
// },



// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Paga", "Estornada", "Autorizada","Recusada"],
    datasets: [{
      data: [7,3,2,1],
      backgroundColor: ['#1cc88a','#6045af', '#f6c23e', '#e74a3b'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
