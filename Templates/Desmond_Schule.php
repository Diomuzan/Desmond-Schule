<?php
$query = "";
$info = "";
$studentName = "";
$subject = "";
$grade = "";
$error = "";

try {
    $db = new PDO("mysql:host=localhost;dbname=gradesnscores", "root", "");
    $query = $db->prepare("SELECT * FROM result");
    $query->execute();

    $info = $query->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['subButton'])) {
        if (isset($_POST['studentName'])) {
            $studentName = $_POST['studentName'];
        }
        if (isset($_POST['subject'])) {
            $subject = $_POST['subject'];
        }
        if (isset($_POST['grade'])) {
            $grade = $_POST['grade'];
        }
        $query = $db->prepare("INSERT INTO result (student, subject, grade) VALUES (:studentName, :subject, :grade)");
        $query->bindParam(':studentName', $studentName);
        $query->bindParam(':subject', $subject);
        $query->bindParam(':grade', $grade);
        $query->execute();
    }
    } catch (PDOException $error) {
        die("Error!:" . $error->getMessage());
    }
$db = null;
?>

<!DOCTYPE HTML>
    <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>

            <h1 class= "position-relative" style= "display: inline-block; top: -150px; left: 450px; ">Desmond Schule</h1>

            <p class= "position-relative" style= "display: inline-block; position: relative; top: 200px; left: -100px;"><?php  foreach ($info as $data) { echo $data["id"] . " "; echo $data["student"]. " "; echo $data["subject"]. " "; echo $data["grade"]. "<br>"; }?></p>

            <form method= "POST" class= "position-relative" style= "width: 650px; top: -33px; left: 590px;">
                <div class="mb-3">
                    <label>Student name</label>
                    <input type="text" class="form-control" name= "studentName">
                </div>
                <div class="mb-3">
                    <label>Subject</label>
                    <input type="text" class="form-control" name= "subject">
                </div>
                <div class="mb-3">
                    <label>Grade</label>
                    <input type="text" class="form-control" name= "grade">
                </div>
                <button type="submit" class="btn btn-primary" name= "subButton">Submit</button>
            </form>



            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
