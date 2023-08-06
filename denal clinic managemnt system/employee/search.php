<!DOCTYPE html>
<html>
<head>
  <title>Search Page</title>
  
  <link rel="stylesheet" href="css/edit.css">
  <style>
    /* CSS styles for the search page and suggestions feature */
    body {
      font-family: Arial, sans-serif;
    }
    
    h1 {
      text-align: center;
    }
    
    form {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }
    
    label {
      margin-right: 10px;
    }
    
    input[type="text"] {
      padding: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-right: 10px;
    }
    
    input[type="submit"] {
      padding: 5px 10px;
      border-radius: 5px;
      border: none;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
    }
    
    table {
      background-color: white;
      border-collapse: collapse;
      width: 100%;
    }
    
    thead {
      background-color: #007bff;
      color: #fff;
    }
    
    thead th {
      padding: 10px;
    }
    
    tbody tr:nth-child(even) {
      background-color: #007bdd;
    }
    
    tbody td {
      padding: 10px;
      border: 1px solid #ccc;
    }
    
    .autocomplete-items {
      position: absolute;
      z-index: 999;
      top: 100%;
      left: 0;
      right: 0;
      max-height: 200px;
      overflow-y: auto;
      border: 1px solid #ccc;
      border-top: none;
    }
    
    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
    }
    
    .autocomplete-items div:hover {
      background-color: #e9e9e9;
    }
    
    .autocomplete-active {
      background-color: #007bff !important;
      color: #fff;
    }
  </style>
</head>
<body>
 <?php include_once'repheader.php';?>   
  <h1>Search Page</h1>
  
  <form method="GET" action="search.php">
    <label for="search1">Search by Name:</label>
    <input type="text" id="search1" name="search1" autocomplete="off">
    <div class="autocomplete-items"></div>
    <input type="submit" value="Search">
  </form>
  
  <?php
  // Check if the form has been submitted
  if (isset($_GET['search1'])) {
    // Connect to the database
    include_once 'db.php';

    // Get the search query
    $search1 = mysqli_real_escape_string($conn, $_GET['search1']);

    // Build the SQL query based on the search query
    $sql = "SELECT * FROM approve_patient WHERE first_name LIKE '%$search1%'";
    $result = mysqli_query($conn, $sql);

    // Check if there are any search results
    if (mysqli_num_rows($result) > 0) {
      // Output the search results in a table
      echo '<h2>Search Results:</h2>';
      echo '<table>';
      echo '<thead>';
      echo '<tr>';
      echo '<th>id</th>';
      echo '<th>Name</th>';
      echo '<th>gender</th>';
      echo '<th>reasone</th>';
      echo '<th>Send</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['first_name'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['reasone'] . '</td>';
        echo '<td>'
        ?>
           <form method="POST" action="insert.php">
    <label for="doctor">Doctor:</label>
    <select id="doctor" name="insert" required>
        <option value="">Select a doctor</option>
        <?php
        $sql = "SELECT first_name FROM employee WHERE job_title='Doctor'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($conn);
        } else {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["first_name"] . '">' . $row["first_name"] . '</option>';
            }
        }
        ?>
    </select>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit" value="Submit">
</form>
            <?php
        '</td>';
        echo '</tr>';
    }

      echo '</tbody>';
      echo '</table>';
    } else {
      // Output a message if there are nosearch results
      echo 'No search results found.';
    }

    // Close the database connection
    mysqli_close($conn);
  }
  ?>
<style>
  form {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    max-width: 500px;
  }
  
  label {
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  select,
  input[type="text"] {
    font-size: 16px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
    width: 100%;
    max-width: 400px;
  }
  
  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease-in-out;
  }
  
  input[type="submit"]:hover {
    background-color: #3e8e41;
  }
  
  input[type="submit"]:active {
    transform: translateY(1px);
  }
</style>
  <script>
  // Get the search bar element
  var search1 = document.getElementById("search1");

  // Add an event listener to the search bar
  search1.addEventListener("input", function(e) {
    var searchQuery = e.target.value;

    if (searchQuery.length < 3) {
      return;
    }

    // Send an AJAX request to the PHP script
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        var suggestions = JSON.parse(this.responseText);

        // Update the suggestion list with the new suggestions
        updateSuggestions(suggestions);
      }
    };
    xhr.open("GET", "suggest.php?search1=" + searchQuery, true);
    xhr.send();
  });

  // Update the suggestion list with new suggestions
  function updateSuggestions(suggestions) {
    var autocompleteList = document.querySelector(".autocomplete-items");
    autocompleteList.innerHTML = "";

    for (var i = 0; i < suggestions.length; i++) {
      var suggestion = suggestions[i];
      var suggestionElement = document.createElement("div");
      suggestionElement.textContent = suggestion.name;
      suggestionElement.addEventListener("click", function(e) {
        search1.value = e.target.textContent;
        autocompleteList.innerHTML = "";
     });
      autocompleteList.appendChild(suggestionElement);
    }
  }
  </script>
</body>
</html>