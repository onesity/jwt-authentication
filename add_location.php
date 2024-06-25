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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'description'
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .main-div {
            display: flex;
        }

        .right-div {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        #submit_btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #submit_btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="main-div">
        <?php sidenavbar() ?>
        <div class="right-div">
            <button id="hamburger_btn">&#x2716;</button>

            <h1>Trip Details Form</h1>
            <form id="tripForm" method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tripTitle">Trip Title</label>
                    <input type="text" id="tripTitle" name="title" maxlength="255" required>
                </div>
                <div class="form-group">

                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <?php
                        $query = "select * from category order by id desc";
                        $res = mysqli_query($conn, $query);
                        $total_record = mysqli_num_rows($res);
                        $sr = 1;
                        while ($total_record != 0) {
                            $record = mysqli_fetch_assoc($res);
                            $id = $record['id'];
                            $category_name = $record['name'];
                            echo "<option value='$id'>$category_name</option>";
                            $total_record--;
                            $sr++;
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" maxlength="12000" required ></textarea>
                    <small>Max length: 2000 words (approximately 12000 characters)</small>
                </div>
                <div class="form-group">
                    <label for="images">Images</label>
                    <input type="file" id="images" name="images" accept="image/*" multiple required>
                    <small>Max images: 3</small>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" max="99999999999" required>
                </div>
                <div class="form-group">
                    <label for="days">Number of Days</label>
                    <input type="number" id="days" name="days" max="999" required>
                </div>

                <button type="submit" id="submit_btn" name="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('tripForm').addEventListener('submit', function(event) {
            let isValid = true;
            const title = document.getElementById('tripTitle').value;
            const description = document.getElementById('description').value;
            const images = document.getElementById('images').files;
            const price = document.getElementById('price').value;
            const days = document.getElementById('days').value;
            const category = document.getElementById('category').value;

            // Validate title
            if (title.length > 255) {
                alert('Trip title cannot exceed 255 characters.');
                isValid = false;
            }

            // Validate description
            const wordCount = description.split(/\s+/).filter(word => word.length > 0).length;
            if (wordCount > 2000) {
                alert('Description cannot exceed 2000 words.');
                isValid = false;
            }

            // Validate images
            if (images.length > 3) {
                alert('You can upload a maximum of 3 images.');
                isValid = false;
            }

            // Validate price
            if (price.length > 11) {
                alert('Price cannot exceed 11 digits.');
                isValid = false;
            }

            // Validate days
            if (days.length > 3) {
                alert('Number of days cannot exceed 3 digits.');
                isValid = false;
            }

            // Validate category
            if (category === '') {
                alert('Please select a category.');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>

<?php
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $categoryid=$_POST['category'];
    $description=$_POST['description'];
    $image='fsdfsdfsdfsdfs';
    $price=$_POST['price'];
    $days=$_POST['days'];
    $timecreated=time();
    $status=1;
    $query="insert into travel(categoryid,title,description,image,price,days,status,timecreated) values('$categoryid','$title','$description','$image','$price','$days','$status','$timecreated')";
    $res=mysqli_query($conn,$query);
    if($res){
        echo "Travel added successfully!";
    }else{
        echo $query;
    }
}
include('footer.php');
?>