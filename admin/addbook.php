

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>New Book</title>
    <style>
        header {
            background: #333;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 10px; /* Add some padding to create space for the content below */
            z-index: 1000; /* Ensure the header is above other elements */
        }

        body {
            margin: 0; /* Remove default margin */
            background-color: #e5eaf5;
        }

        main {
            margin-top: 60px; /* Adjust this value to create space below the fixed header */
            padding-top: 20px; /* Add padding-top to prevent content from being covered */
        }

        .overview-container {
            display: flex;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
        }

        .overview-box {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            background-color:whitesmoke;
            margin-bottom: 20px;
            margin-top: 190px; /* Adjust the margin-top value to lower or raise the forms */
        }
        .column {
            flex: 48%; /* Adjust the width of each column */
            padding-left: 30px  ;
        }

        .column label {
            margin-bottom: 8px;
            display: block;
        }

        .column input,
        .column select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #845bb3;
            color: black;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d0bdf4;
        }
        .dashboard-buttons button.addbook {
        background-color: #845bb3; /* Set your desired background color */
    }
    
    </style>
</head>
<body>
    <header><?php include'../admin/adash.php'; ?></header>
    <main>
        <div class="overview-container">
            <div class="overview-box">
                <h2>Add Book</h2>
                <div class="column">
                    <form action="add_book.php" method="post">
                        <!-- Your form fields here -->
                        <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>

                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required>

                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" required>

                    <label for="publisher">Publisher:</label>
                    <input type="text" id="publisher" name="publisher">

                    <label for="publication_date">Publication Date:</label>
                    <input type="date" id="publication_date" name="publication_date">

                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre">
                    
                </div>

                <div class="column">
                    
                        <!-- Your form fields here -->
                        <label for="language">Language:</label>
                    <input type="text" id="language" name="language">

                    <label for="edition">Edition:</label>
                    <input type="text" id="edition" name="edition">

                    <label for="copies">Copies:</label>
                    <input type="number" id="copies" name="copies" min="1" value="1" required>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="Available">Available</option>
                      
                    </select>

                    <input type="submit" value="Add Book">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>


               

