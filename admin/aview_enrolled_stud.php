<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <title>View Students</title>
      <style>
        header {
            background: #333;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 10px;
            z-index: 1000;
        }

        body {
            margin: 0;
            background-color: #e5eaf5;
        }

        .container {
            max-width: 2000px;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 230px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            height: 30px;
        }

        th {
            background-color: #845bb3;
            color: #fff;
        }

        .borrowed-btn {
            background-color: #e74c3c; /* Red color for borrowed status */
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .returned-btn {
            background-color: #3498db; /* Blue color for returned status */
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .disabled-btn {
            pointer-events: none;
            opacity: 0.5; /* Optional: Reduce opacity to visually indicate disabled state */
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #ddd;
            color: #333;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #845bb3;
            color: #fff;
        }

        .pagination .active {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>
<body>
    <header><?php include 'adash.php'; ?></header>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Assuming you have a database connection established
                   include'../edu_conn.php';

                   $limit = 10;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Fetch data from the database with pagination
                    $sql = "SELECT stud_num, fname, lname, gender FROM stud_infotb LIMIT $offset, $limit";
                    $result = $conn->query($sql);

                    // Display data in the table
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['stud_num'] . "</td>";
                            echo "<td>" . $row['fname'] . "</td>";
                            echo "<td>" . $row['lname'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No data found</td></tr>";
                    }

                    // Close the connection
                  
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
                $sql = "SELECT COUNT(*) as total FROM stud_infotb";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $total_pages = ceil($row['total'] / $limit);

                if ($page > 1) {
                    echo "<a href='?page=" . ($page - 1) . "'>&laquo; Previous</a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    $activeClass = ($i == $page) ? 'active' : '';
                    echo "<a href='?page=" . $i . "' class='$activeClass'>" . $i . "</a>";
                }

                if ($page < $total_pages) {
                    echo "<a href='?page=" . ($page + 1) . "'>Next &raquo;</a>";
                }
            ?>
        </div>
    </div>
</body>
</html>
</html>