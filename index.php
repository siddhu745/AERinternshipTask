<!DOCTYPE html>
<html>
<head>
  <title>Health Report Form</title>
  <link rel="stylesheet" href="form.css" />
</head>
<body>
<div class="form-container">
    <h1>Health Report Form</h1>
    <form id="healthReportForm" action="submit.php" method="POST" enctype="multipart/form-data">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="age">Age:</label>
      <input type="number" id="age" name="age" required>

      <label for="weight">Weight:</label>
      <input type="number" id="weight" name="weight" required>

      <label for="email">Email Id:</label>
      <input type="email" id="email" name="email" required>

      <label for="healthReport">Upload Health Report:</label>
      <input type="file" id="healthReport" name="healthReport" accept="application/pdf" required>

      <input type="submit" value="Submit">
    </form>
  </div>

  <div><br><br>To fetch the health report based on the email ID,<br> you can construct a URL in the following format: <h5>localhost/AnExtraRepTASK/fetch_report.php?email=example@example.com</h5> (replace localhost with your web server's address if needed and example@example.com with the desired email ID).
Open this URL in your web browser, and the health report PDF file will be downloaded.</div>
  <script>
    document.getElementById("healthReportForm").addEventListener("submit", function(e) {
      e.preventDefault(); // Prevent form submission

      var form = e.target;
      var formData = new FormData(form);

      // Make an AJAX request to the PHP endpoint for form submission
      var xhr = new XMLHttpRequest();
      xhr.open("POST", form.action, true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          alert("Form submitted successfully!");
          form.reset(); // Reset the form after successful submission
        } else {
          alert("An error occurred while submitting the form.");
        }
      };
      xhr.send(formData);
    });
  </script>
</body>
</html>
