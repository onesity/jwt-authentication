<?php
include('header.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Details Form</title>
    <link rel="stylesheet" href="page_style.css">
    <style>
        #add_location_btn_link{
            text-decoration: none;
            color: white;
        }
    </style>

</head>

<body>
    <div class="main-div">
        <?php
        sidenavbar()
        ?>
        <div class="right-div">
            <button id="hamburger_btn">&#x2716;</button>
            <div class="container">
                <h2 id="catgory_heading">Add new trip </h2>
                <button type="button" class="btn btn-primary" id='create_category_btn'>
                    <a href="add_location.php" id="add_location_btn_link">Add new trip</a>
                </button>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th> Action</th>

                        </tr>
                    </thead>
                    <!-- <tbody>
                        <?php
                        $query = "select * from category order by id desc";
                        $res = mysqli_query($conn, $query);
                        $total_record = mysqli_num_rows($res);
                        $sr = 1;
                        while ($total_record != 0) {
                            $record = mysqli_fetch_assoc($res);
                            $category_name = $record['name'];
                            $status = $record['status'];
                            $timecreated = date('Y-m-d', $record['timecreated']);
                            if ($record['timemodified'] == 0) {
                                $timemodified = 'NA';
                            } else {
                                $timemodified = date('Y-m-d', $record['timemodified']);
                            }
                            echo "<tr>
                    <td>$sr</td>
                    <td>$category_name</td>
                    <td>$status</td>
                    <td>$timecreated</td>
                    <td>$timemodified</td>
                    <td>Edit</td>
                    </tr>";
                            $total_record--;
                            $sr++;
                        }
                        ?>

                    </tbody> -->

                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</body>

</html>

<?php
include('footer.php');
?>