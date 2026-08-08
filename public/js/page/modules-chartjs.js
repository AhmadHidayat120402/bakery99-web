"use strict";

var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                350,
                350,
            ],
            backgroundColor: [
                '#ecc023',
                '#347928',
            ],
            label: 'Dataset 1'
        }],
        labels: [
            'JUMLAH SUARA BUDI SANTOSO',
            'JUMLAH SUARA GIANTORO',
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: false
        },
    }
});
