  <?php
    //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
    $connect=mysqli_connect("localhost","root","","bayanione_db");
    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //code to display donation posts
    $result = mysqli_query($connect,"SELECT * FROM post INNER JOIN donation_campaign ON post.post_id=donation_campaign.post_id INNER JOIN users ON users.user_id=post.user_id WHERE post_type='donation campaign'");

    while($row = mysqli_fetch_assoc($result))
    {
      echo "<table style='width: 500px; height: 500px; background-color: #ffffff;'>";
        echo "<tbody>";
          echo "<form action='home.php' method='post'>";
            echo "<tr>";
              echo "<td style='text-align: left; padding: 10px;'>";
                  echo "<img class='img-circle' src='Uploads/",$row['user_photo'],"' width='50px' height='50px' />";
                  echo "</br>";
                echo "<label name='username' id='username' value =" . $row['username'] . ">". $row['username'] ."</label>";
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<label type='text' name='tag_user' id='tag_user' value =" . $row['tag_user'] . ">". $row['tag_user'] ."</label>";
                  echo "</br>";
              echo "<td style='text-align: left; padding: 10px;'>";
                echo "<label type='text' name='post_type' id='post_type' value =" . $row['post_type'] . ">" . $row['post_type'] ."</label>";
                  echo "</br>";
                echo "<label type='text' name='post_status' id='post_status' value =" . $row['post_status'] . ">" . $row['post_status'] ."</label>";
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<label type='text' name='create_date' id='post_status' value =" . $row['create_date'] . ">" . $row['create_date'] ."</label>";
                  echo "</br>";
                echo "<img src='Uploads/",$row['campaign_photo'],"' width='300px' height='250px' />";
                  echo "</br>";
                echo "<label type='text' name='total_like' id='total_like' value =" . $row['total_like'] . ">" . $row['total_like'] ."</label>";
              echo "<td>";
            echo "</tr>";
          echo "</form>";
        echo "</tbody>";
      echo "</table>";
      echo "</br>";
    }
    mysqli_close($connect);
?>
