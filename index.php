<!DOCTYPE HTML>
<html>
<head>
<title>Mr. Riley's Plagiarism Checker</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
// define variables and set to empty values
$reportSubjectErr = $reportTextErr = "";
$reportSubject = $reportText = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["reportSubject"])) {
    $reportSubjectErr = "Subject is required";
  } else {
    $reportSubject = test_input($_POST["reportSubject"]);

  }

  if (empty($_POST["reportText"])) {
    $reportTextErr = "Report Text is required";
  } else {
    $reportText = test_input($_POST["reportText"]);

    //replace parenthesis with spaces
    $reportText = str_replace("("," ",$reportText);
    $reportText = str_replace(")"," ",$reportText);
    //split reportText into sentences
    $sentences = explode('.',$reportText);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Mr. Riley's Plagiarism Checker</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Report subject: <input type="text" name="reportSubject" value="<?php echo $reportSubject;?>">
  <span class="error">* <?php echo $reportSubjectErr;?></span>
  <br><br>
  Report text: <textarea name="reportText" rows="5" cols="40"><?php echo $reportText;?></textarea>
  <span class="error">* <?php echo $reportTextErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Results:</h2>";
echo $reportSubject;
echo "<br><br>";

//loop through each $sentences
foreach ($sentences as $oneSent) {
    echo "<a href='https://www.google.com/search?q=" . $reportSubject . "+$oneSent' target='_blank'>$oneSent</a><br><br>";
}

echo "<br><br>";
?>

</body>
</html>
