<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Details Form</title>


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
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
            margin: 20px;
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
            width: 180px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            /* margin: 20px; */
            margin-left: 20px;
            margin-bottom: 20px;
        }


        #submit_btn:hover {
            background-color: #0056b3;
        }

        #page_heading {
            margin-left: 20px;
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="main-div">
        <?php
        sidenavbar();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = -1;
        }

        if ($id != -1 && $id != 0) {
            $query = "select t.title,t.description,t.image,t.price,t.days,t.categoryid,c.name from travel as t join category as c on t.categoryid=c.id where t.id=$id";
            $query_res = mysqli_query($conn, $query);
            if ($query_res) {
                $data = mysqli_fetch_assoc($query_res);
                $title = $data['title'];
                $categoryid = $data['categoryid'];
                $category_name = $data['name'];
                $description = $data['description'];
                $image = $data['image'];
                $price = $data['price'];
                $days = $data['days'];
            }
            $submit_btn_title = 'Update';
        } else {
            $title = null;
            $category_name = null;
            $description = null;
            $image = null;
            $price = null;
            $days = null;
            $submit_btn_title = 'Submit';
        }
        ?>
        <div class="right-div">
            <button id="hamburger_btn">&#x2716;</button>

            <h1 id="page_heading">Trip Details Form</h1>
            <form id="tripForm" method="POST" action="#" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <input type="hidden" value="<?php echo $image; ?>" name="old_image">
                <div class="form-group">
                    <label for="tripTitle">Trip Title</label>
                    <input type="text" id="tripTitle" name="title" maxlength="255" value="<?php echo $title; ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>

                        <?php
                        if ((int)$id !== -1 && (int)$id !== 0) {
                            echo "<option value='$categoryid' >$category_name</option>";
                        } else {
                            echo "<option value='0'>Select Category</option>";
                        }
                        $query = "select * from category order by id desc";
                        $res = mysqli_query($conn, $query);
                        $total_record = mysqli_num_rows($res);
                        $sr = 1;
                        while ($total_record != 0) {
                            $record = mysqli_fetch_assoc($res);
                            $id = $record['id'];
                            $category_name = $record['name'];
                            if ($categoryid==$id) {
                                continue;
                            } else {
                                echo "<option value='$id'>$category_name</option>";
                            }
                            $total_record--;
                            $sr++;
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group  row-12 col-12">
                    <label for="description">Description</label>
                    <textarea  id="description" name="description" maxlength="12000" value="" required><?php echo $description; ?></textarea>
                    <small>Max length: 2000 words (approximately 12000 characters)</small>
                </div>

                <div class="form-group">
                    <label for="images">Images</label>
                    <input type="file" id="fileInput" name="images" accept="image/*" id="fileInput" multiple required>
                    <small>Max images: 3</small>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" max="99999999999" value="<?php echo $price; ?>" required>
                </div>

                <div class="form-group">
                    <label for="days">Number of Days</label>
                    <input type="number" id="days" name="days" max="999" value="<?php echo $days; ?>" required>
                </div>

                <input type="submit" id="submit_btn" name="submit" value="<?php echo $submit_btn_title; ?>">

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

        document.getElementById('fileInput').addEventListener('change', function() {
            // Get the file input element
            var input = this;

            // Check if a file is selected
            if (input.files && input.files.length > 0) {
                // Get the first file from the FileList
                var file = input.files[0];

                // Get the file name
                var fileName = file.name;

                // Display the file name in the paragraph
                // document.getElementById('fileName').textContent = 'Selected file: ' + fileName;
                console.log(fileName);
            } else {
                // document.getElementById('fileName').textContent = 'No file selected';
            }
        });
    </script>


</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $categoryid = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $days = $_POST['days'];

    $id = $_POST['id'];

    $old_image=$_POST['old_image'];
    if($old_image!=null){
        if(file_exists($old_image)){
            unlink($old_image);
        }
        $filename = $id.'_'.$_FILES['images']['name'];
    }else{
        
        $last_record_query='select id from travel order by id desc';
        $last_record_query_res=mysqli_query($conn,$last_record_query);
        $last_record_data=mysqli_fetch_assoc($last_record_query_res);
        $last_record_id=$last_record_data['id']+1;
        $filename = $last_record_id.'_'.$_FILES['images']['name'];
      
    }
    $baseUrl = 'images/';
    $targetFilePath = $baseUrl . $filename;
    $upload_res = move_uploaded_file($_FILES['images']['tmp_name'], $targetFilePath);
    $image = $targetFilePath;
    
    if ($id != -1 && $id != 0) {
        $timemodified = time();
        $query = "update travel set title='$title',image='$image',description='$description',categoryid='$categoryid',price='$price',days='$days', timemodified='$timemodified' where id='$id'";
        $msg = 'Record updates Successfully!';
    } else {
        $timecreated = time();
        $status = 1;
        $query = "insert into travel(categoryid,title,description,image,price,days,status,timecreated) values('$categoryid','$title','$description','$image','$price','$days','$status','$timecreated')";
        $msg = 'Travel Created Successfully!';
    }

    $res = mysqli_query($conn, $query);
    if ($res == true) {
        success_modal($msg);
    } else {
        success_modal('Failed! Something went wrong!');
    }
}
include('footer.php');
?>