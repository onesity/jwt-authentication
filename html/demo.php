<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Icons Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- Your content here -->

    <!-- Icons examples -->
    <i class="bi bi-pencil-square"></i> <!-- Edit icon -->
    <i class="bi bi-trash"></i> <!-- Delete icon -->
    <i class="bi bi-eye"></i> <!-- View (eye) icon -->

    <!-- Your content here -->
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Preview</title>
</head>
<body>
    <form>
        <label for="fileInput">Select an image:</label>
        <input type="file" id="fileInput" accept="image/*" multiple>
        <p id="fileName"></p>
        <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 200px;">
    </form>

    <script src="script.js"></script>
</body>
</html>


<script>
document.getElementById('fileInput').addEventListener('change', function() {
    var input = this;

    if (input.files && input.files.length > 0) {
        var file = input.files[0];
        var fileName = file.name;

        // Display the file name
        document.getElementById('fileName').textContent = 'Selected file: ' + fileName;

        // Create a FileReader object
        var reader = new FileReader();

        // Set up the onload event to display the image preview
        reader.onload = function(e) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    } else {
        document.getElementById('fileName').textContent = 'No file selected';
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.src = '';
        imagePreview.style.display = 'none';
    }
});


</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Packages</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover; /* You can use cover, contain, or fill based on your need */
        }
        .card {
            width: 100%; /* Or any specific width you need */
            height: auto; /* Or a specific height if needed */
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="your-image-url.jpg" class="card-img-top" alt="Travel Package">
                    <div class="card-body">
                        <h5 class="card-title">Package Title</h5>
                        <p class="card-text">Package description goes here.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
