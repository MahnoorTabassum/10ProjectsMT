<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$db = "fileupload";

$con = mysqli_connect($servername, $username, $password, $db);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$modalMessage = '';

if (isset($_FILES["files"])) {
    
    // Escaping the filename to handle special characters
    $name = mysqli_real_escape_string($con, $_FILES["files"]["name"]);
    $tmpname = $_FILES["files"]["tmp_name"];
    $type = $_FILES["files"]["type"];
    $size = $_FILES["files"]["size"];
    
    // Allow only PDF and DOCX files
    $allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if (in_array($type, $allowedTypes)) {
        
        $uploadPath = "uploads/" . basename($name);
        
        // Moving the uploaded file
        $uploadSuccess = move_uploaded_file($tmpname, $uploadPath);
        
        if ($uploadSuccess) {
            
            // Escaping the file path as well for special characters
            $uploadPathEscaped = mysqli_real_escape_string($con, $uploadPath);

            // Inserting into the database
            $sqlInsert = "INSERT INTO info (name, type, size, path) VALUES ('$name', '$type', '$size', '$uploadPathEscaped')";
            $res = mysqli_query($con, $sqlInsert);
            
            if ($res) {
                $modalMessage = "File uploaded and resume information saved successfully.";
            } else {
                $modalMessage = "Error saving resume information: " . mysqli_error($con);
            }
        } else {
            $modalMessage = "Error uploading file.";
        }
    } else {
        $modalMessage = "Only PDF and DOCX files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resume</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
    background: #403B4A;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #E7E9BB, #403B4A);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #E7E9BB, #403B4A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    padding: 0;
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.baskervville-sc-regular {
  font-family: "Baskervville SC", system-ui;
  font-weight: 400;
  font-style: normal;
}


h1 {
    font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
    text-align: center;
    margin-bottom: 20px;
    color: black;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.upload-container {
    width: 90%;
    max-width: 500px;
    margin: auto;
    background-color: #F7F7F7;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    padding: 30px;
    border: 1px solid #34A85A;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.upload-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
}

label {
    display: block;
    margin-bottom: 15px;
    color: #333;
    font-weight: bold;
}

input[type="file"] {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 8px;
    background-color: #E5E5EA;
    color: #333;
    font-size: 16px;
    margin-bottom: 20px;
}

input[type="submit"] {
    width: 100%;
    background: #3C3B3F;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #605C3C, #3C3B3F);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #605C3C, #3C3B3F); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color: #fff;
    padding: 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #7A288A;
    transform: scale(1.05);
}

.file-hint {
    font-size: 12px;
    color: #666;
}

@media (max-width: 768px) {
    .upload-container {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .upload-container {
        width: 100%;
    }
}

    </style>
</head>
<body>
    <div class="upload-container">
        <h1>Upload Your Resume</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <label for="uf">Select Resume File:</label>
            <input type="file" name="files" id="uf" required>
            <p class="file-hint">Accepted formats: PDF, DOCX (Max size: 2MB)</p>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Upload Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php if (!empty($modalMessage)) { echo $modalMessage; } ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            <?php if (!empty($modalMessage)) { ?>
                $('#uploadModal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>
