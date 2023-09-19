<!DOCTYPE html>
<html>
<head>
    <title>Searchable Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom CSS styles here to match the SB Admin style */
    </style>
</head>
<body>
    <div class="container">
        <h2>Searchable Table</h2>
        <input type="text" id="search" class="form-control" placeholder="Search...">
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Replace this with your database query or data source
                $data = [
                    ['1', 'John Doe', 'john@example.com'],
                    ['2', 'Jane Smith', 'jane@example.com'],
                    ['3', 'Bob Johnson', 'bob@example.com'],
                    // Add more rows as needed
                ];

                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>{$row[0]}</td>";
                    echo "<td>{$row[1]}</td>";
                    echo "<td>{$row[2]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript to enable table search
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
