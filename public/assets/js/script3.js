// dashboard.js (View ile ilişkilendirilmiş bir JavaScript dosyası)
const salesData = JSON.parse('{{ json_encode($salesData) }}');
const months = JSON.parse('{{ json_encode($months) }}');

const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Satışlar',
            data: salesData,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
