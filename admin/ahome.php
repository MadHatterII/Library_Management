<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Library Management</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .welcome-section {
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .chart-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            height: 100px;
        }

        /* Adjusted size for charts */
        #bookCategoriesChart,
        #borrowedBooksChart {
            width: 100%; /* Make the charts fill the container width */
            max-width: 900px; /* Set a maximum width to avoid overly large charts */
            height: 100px; /* Set a specific height for the charts */
        }
    </style>
</head>
<body>
    <header>
        <?php include '../admin/adash.php'; ?>
    </header>
    <div class="welcome-section">
        <h2>Welcome to the Library Management System!</h2>
        <p>This system allows you to manage and organize the library resources efficiently.</p>
    </div>
    <!-- Chart Section -->
    <div class="chart-container">
        <!-- Book Categories Chart -->
        <canvas id="bookCategoriesChart"></canvas>

        <!-- Borrowed Books Status Chart -->
        <canvas id="borrowedBooksChart"></canvas>
    </div>

    <script>
        // Sample data for book categories
        var bookCategoriesData = {
            labels: ['Fiction', 'Non-Fiction', 'Science', 'History', 'Mystery'],
            datasets: [{
                label: 'Number of Books',
                data: [50, 30, 20, 40, 15],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        document.addEventListener("DOMContentLoaded", function () {
            // Book Categories Chart
            var bookCategoriesCtx = document.getElementById('bookCategoriesChart').getContext('2d');
            var bookCategoriesChart = new Chart(bookCategoriesCtx, {
                type: 'bar',
                data: bookCategoriesData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Borrowed Books Status Chart
            var borrowedBooksCtx = document.getElementById('borrowedBooksChart').getContext('2d');
            var borrowedBooksChart = new Chart(borrowedBooksCtx, {
                type: 'doughnut',
                data: borrowedBooksData,
                options: {}
            });
        });
    </script>
</body>
</html>
