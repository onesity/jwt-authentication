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
