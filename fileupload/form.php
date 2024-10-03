<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload with Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="bg-image shadow-1-strong" 
     style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');
            height: 100vh">

  <div class="container col-12 col-sm-6 col-md-4 pt-2 mb-5 bg-opacity-50% ">
     <div class="row">
      <div class="card mt-2 mx-auto p-4">
     
    <form action ="frmdb.php" method="post" enctype="multipart/form-data">
       <h1>Fill the Details</h1>

        <label class="form-group" for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username" required></input>

        <label class="form-group" for="email">Email-id</label>
        <input class="form-control" type="email" name="email" id="email-id" required></input>

        <label class="form-group" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password" required></input>

        <label class="form-group" for="file_select">Select file to upload</label>
        <input class="form-control" type="file" name="file" id="file_select" accept=".pdf,.doc,.docx,.png,.jpg" required></input>

        <!-- Preview section for the uploaded file -->
        <div id="file_preview" class="mt-3" style="display:none;">
            <h5>File Preview:</h5>
            <!-- For displaying image preview -->
            <img id="img_preview" src="" alt="Image Preview" style="display:none; max-width: 100%; height: auto;" />

            <!-- For displaying PDF preview -->
            <embed id="pdf_preview" type="application/pdf" width="100%" height="300px" style="display:none;" />

            <!-- For displaying file name and metadata -->
            <p id="file_info" style="display:none;"></p>
        </div>

        <button class="btn-primary btn-outline-light pt-2 pb-2 ps-2 py-2 mt-3" type="submit" value="uploaded file" name="submit">Submit</button>
        <p><strong>Note:</strong> Only upload PDF, DOC, DOCX, JPG, and PNG files (Max size: 300KB)</p>
      </form>
    </div>
  </div>
</div>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  button {
    align-items: center;
  }
  .card {
    align-items: center;
  }
</style>

<script>
  // JavaScript function to handle file preview
  document.getElementById('file_select').addEventListener('change', function() {
    const fileInput = this.files[0];
    const previewContainer = document.getElementById('file_preview');
    const imgPreview = document.getElementById('img_preview');
    const pdfPreview = document.getElementById('pdf_preview');
    const fileInfo = document.getElementById('file_info');
    
    previewContainer.style.display = 'none';
    imgPreview.style.display = 'none';
    pdfPreview.style.display = 'none';
    fileInfo.style.display = 'none';

    if (fileInput) {
      const fileType = fileInput.type;

      // Reset preview fields
      imgPreview.src = "";
      pdfPreview.src = "";

      const reader = new FileReader();

      // If the file is an image (jpg/png), display it
      if (fileType.startsWith('image/')) {
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
        };
        reader.readAsDataURL(fileInput);
      }
      // If the file is a PDF, display it in the <embed> tag
      else if (fileType === 'application/pdf') {
        const fileURL = URL.createObjectURL(fileInput);
        pdfPreview.src = fileURL;
        pdfPreview.style.display = 'block';
      }
      // For other file types (e.g., DOC/DOCX), just show the file name and size
      else {
        fileInfo.textContent = `Selected File: ${fileInput.name} (${(fileInput.size / 1024).toFixed(2)} KB)`;
        fileInfo.style.display = 'block';
      }

      // Show the preview container
      previewContainer.style.display = 'block';
    }
  });
</script>

<?php
if (isset($_POST['submit'])) {
    $allowedTypes = array("pdf" => "application/pdf", "doc" => "application/msword", "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "jpg" => "image/jpeg", "png" => "image/png");
    $file = $_FILES["file"];
    $name = $file["name"];
    $type = $file["type"];
    $ext = pathinfo($name, PATHINFO_EXTENSION);

    // Check file size (max 300KB)
    if ($file["size"] > 300000) {
        echo "Uploaded file is too large. Please upload a file smaller than 300KB.";
    }
    // Check file type
    elseif (!array_key_exists($ext, $allowedTypes) || $type != $allowedTypes[$ext]) {
        echo '<script>alert("Invalid file type. Only PDF, DOC/DOCX, JPG, and PNG files are allowed.")</script>';
    } else {
        // File is valid; proceed with upload (you might want to move the file)
        //  $uploadFolder = "uploads/";
        //  $filePath = $uploadFolder . basename($name);
        //  move_uploaded_file($file["tmp_name"], $filePath);
        echo '<script>alert("File uploaded successfully!")</script>';
    }
}
?>

</body>
</html>