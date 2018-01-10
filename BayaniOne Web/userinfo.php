<script type="text/javascript">
//script code for close button
  window.onload = function(){
      document.getElementById('close').onclick = function(){
          this.parentNode.parentNode.parentNode
          .removeChild(this.parentNode.parentNode);
          return false;
      };
  };
</script>

  <div>
    <a href="home.php"><span id='close'>x</span></a>

        <?php
          //code to get the account_type of the login user
          $connect=mysqli_connect("localhost","root","","bayanione_db");
          // Check connection
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $result = mysqli_query($connect,"SELECT account_type FROM users WHERE username = '".$_SESSION['username']."'");
          while($row = mysqli_fetch_assoc($result))
          {
            echo "<input type=hidden name='account_type' id='account_type' value =" . $row['account_type']. ">";
          }
          mysqli_close($connect);
        ?>

        <?php
          //code to get login user info
          $connect=mysqli_connect("localhost","root","","bayanione_db");
          // Check connection
          if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          //code to get the login user info based on account_type (individual user)
          if($account_type='individual')
          {
            $result = mysqli_query($connect,"SELECT * FROM users INNER JOIN individual_user ON users.user_id=individual_user.user_id WHERE users.username = '".$_SESSION['username']."'");

            while($row = mysqli_fetch_assoc($result))
            {
              echo "<div>";
                echo "<table>";
                  echo "<tbody>";
                  echo "<form action='home.php' method='post'>";
                    echo "<tr>";
                      echo "<td>";
                      echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
                      echo "<img src='Uploads/",$row['user_photo'],"' width='175' height='200' />";
                      echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>" . 'User Full Name:' . "</td>";
                      echo "<td>";
                        echo "<input type='text' id='first_name' name='first_name' value=". $row['first_name'] .">";
                        echo "</br>";
                        echo "<input type='text' id='middle_name' name='middle_name' value=". $row['middle_name'] .">";
                        echo "</br>";
                        echo "<input type='text' id='last_name' name='last_name' value=". $row['last_name'] .">";
                      echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>" . 'Birthday:' . "</td>";
                      echo "<td>" . "<input type='text' id='birthdate' name='birthdate' value=". $row['birthdate'] .">" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>" . 'Residential Address:' . "</td>";
                      echo "<td>" . "<input type='text' id='residential_address' name='residential_address' value=". $row['residential_address'] ." >" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>" . 'Email:' . "</td>";
                      echo "<td>" . "<input type='text' id='email_address' name='email_address' placeholder='user@domain.com' value=". $row['email_address'] ." >" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>" . 'Username:' . "</td>";
                      echo "<td>" . "<input type='text' name='username' id='username' value =" . $row['username']. ">" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>" . 'Password:' . "</td>";
                      echo "<td>" . "<input type='text' name='password' id='password' value =" . $row['password']. ">" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                      //echo "<td>" . "<input type='submit' id='editind' name='editind' value='Edit'>" . "</td>";
                      echo "<td>" . "<input type='submit' id='updateind' name='updateind' value='Update'>" . "</td>";
                    echo "</tr>";
                    echo "</form>";
                  echo "</tbody>";
                echo "</table>";
              echo "</div>";
                  }
                }
                mysqli_close($connect);
        ?>

        <?php include 'databaseconn.php' ?>
        <?php
        if (isset($_POST['updateind'])) {
          $user_id = $_POST['user_id'];
          $first_name = $_POST['first_name'];
          $middle_name = $_POST['middle_name'];
          $last_name = $_POST['last_name'];
          $birthdate = $_POST['birthdate'];
          $residential_address = $_POST['residential_address'];
          $email_address = $_POST['email_address'];
          $username = $_POST['username'];
          $password = $_POST['password'];

          mysqli_query($connect, "UPDATE users SET residential_address='$residential_address', email_address='$email_address', username='$username', password='$password', email='$email' WHERE user_id=$user_id");
          if(mysqli_affected_rows($connect) > 0){
            echo "Successfully Update!";
          }else {
            echo mysqli_error($connect);
            echo "";
          }
            echo "<meta http-equiv='refresh' content='0'>";
          mysqli_query($connect, "UPDATE individual_user SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', birthdate='$birthdate' WHERE user_id=$user_id");

          if(mysqli_affected_rows($connect) > 0){
            echo "Successfully Update!";
          }else {
            echo mysqli_error($connect);
            echo "";
          }
            echo "<meta http-equiv='refresh' content='0'>";
        }
        ?>

      <?php
        //code to get login user info
        $connect=mysqli_connect("localhost","root","","bayanione_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        //code to get the login user info based on account_type (organization user)
        if($account_type='organization')
        {
          $result = mysqli_query($connect,"SELECT * FROM users INNER JOIN organization_user ON users.user_id=organization_user.user_id WHERE users.username = '".$_SESSION['username']."'");

          while($row = mysqli_fetch_assoc($result))
          {
                echo "<div>";
                  echo "<table>";
                    echo "<tbody>";
                    echo "<form action='home.php' method='post'>";
                      echo "<tr>";
                        echo "<td>";
                        echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
                        echo "<img src='Uploads/",$row['user_photo'],"' width='175' height='200' />";
                        echo "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . 'User Full Name:' . "</td>";
                        echo "<td>" . "<input type='text' id='org_name' name='org_name' value=". $row['org_name'] .">" . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . 'Representative Name:' . "</td>";
                        echo "<td>" . "<input type='text' id='rep_name' name='rep_name' value=".$row['rep_name'] .">" . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . 'Residential Address:' . "</td>";
                        echo "<td>" . "<input type='text' id='residential_address' name='residential_address' value=".$row['residential_address'] .">" . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . 'Email:' . "</td>";
                        echo "<td>" . "<input type='text' id='email_address' name='email_address' value=". $row['email_address'] .">" . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . 'Username:' . "</td>";
                        echo "<td>" . "<input type='text' id='username' name='username' value=". $row['username'] ." >" . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . 'Password:' . "</td>";
                        echo "<td>" . "<input type='text' id='password' name='pasword' value=". $row['password'] ." >" . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        //echo "<td>" . "<input type='submit' id='editorg' name='editorg' value='edit'>" . "</td>";
                        echo "<td>" . "<input type='submit' id='updateorg' name='updateorg' value='update'>" . "</td>";
                      echo "</tr>";
                      echo "</form>";
                    echo "</tbody>";
                  echo "</table>";
                echo "</div>";

              }
            }
            mysqli_close($connect);
            ?>

            <?php include 'databaseconn.php' ?>
            <?php
            if (isset($_POST['updateorg'])) {
              $user_id = $_POST['user_id'];
              $org_name = $_POST['org_name'];
              $rep_name = $_POST['rep_name'];
              $residential_address = $_POST['residential_address'];
              $email_address = $_POST['email_address'];
              $username = $_POST['username'];
              $password = $_POST['password'];

              mysqli_query($connect, "UPDATE users SET residential_address='$residential_address', email_address='$email_address', username='$username', password='$password' WHERE user_id=$user_id");
              mysqli_query($connect, "UPDATE organization_user SET org_name='$org_name', rep_name='$rep_name' WHERE user_id=$user_id");

              if(mysqli_affected_rows($connect) > 0){
                echo "Successfully Update!";
              }else {
                echo mysqli_error($connect);
                echo "";
              }
                echo "<meta http-equiv='refresh' content='0'>";
            }
            ?>
</div>
