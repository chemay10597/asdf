<script type="text/javascript">
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
      <form name='' id='' action='' method='post'>
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
          $result = mysqli_query($connect,"SELECT first_name, last_name, middle_name, birthdate, user_photo, residential_address, email_address FROM users INNER JOIN individual_user ON users.user_id=individual_user.user_id WHERE users.username = '".$_SESSION['username']."'");

          while($row = mysqli_fetch_assoc($result))
          {
            echo "<div>";
              echo "<table>";
                echo "<tbody>";
                  echo "<tr>";
                    echo "<td>";
                    echo "<img src='Uploads/",$row['user_photo'],"' width='175' height='200' />";
                    echo "</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>" . 'User Full Name:' . "</td>";
                    echo "<td>";
                      echo "<input type='text' value=". $row['first_name'] .">";
                      echo "<input type='text' value=". $row['middle_name'] .">";
                      echo "<input type='text' value=". $row['last_name'] .">";
                    echo "</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>" . 'Birthday:' . "</td>";
                    echo "<td>" . "<input type='text' value=". $row['birthdate'] .">" . "</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>" . 'Residential Address:' . "</td>";
                    echo "<td>" . "<input type='text' value=". $row['residential_address'] .">" . "</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>" . 'Email:' . "</td>";
                    echo "<td>" . "<input type='text' value=". $row['email_address'] .">" . "</td>";
                  echo "</tr>";
                echo "</tbody>";
              echo "</table>";
            echo "</div>";
          }
        }
        mysqli_close($connect);
      ?>
    </form>
      <form name='' id='' action='' method='post'>
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
        $result = mysqli_query($connect,"SELECT org_name, rep_name, user_photo, residential_address, email_address FROM users INNER JOIN organization_user ON users.user_id=organization_user.user_id WHERE users.username = '".$_SESSION['username']."'");

        while($row = mysqli_fetch_assoc($result))
        {
          echo "<form name='' id='' action='' method='post'>";
          echo "<div>";
            echo "<table>";
              echo "<tbody>";
                echo "<tr>";
                  echo "<td>";
                  echo "<img src='Uploads/",$row['user_photo'],"' width='175' height='200' />";
                  echo "</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>" . 'User Full Name:' . "</td>";
                  echo "<td>" . "<input type='text' name='org_name' value=". $row['org_name'] ." disabled>" . "</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>" . 'Representative Name:' . "</td>";
                  echo "<td>" . "<input type='text' name='rep_name' value=".$row['rep_name'] ." disabled>" . "</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>" . 'Residential Address:' . "</td>";
                  echo "<td>" . "<input type='text' name='residential_address' value=".$row['residential_address'] ." disabled>" . "</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>" . 'Email:' . "</td>";
                  echo "<td>" . "<input type='text' name='email_address' value=". $row['email_address'] ." disabled>" . "</td>";
                echo "</tr>";
              echo "</tbody>";
            echo "</table>";
          echo "</div>";
          echo "</form>";
          }
        }
        mysqli_close($connect);
      ?>
          <input type="button" name='editorg' value='edit'>
          <input type="button" name='updateorg' value='update'>
        </br>
      </form>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>

       $(document).ready(function(){

           $("form input[type=text],form input[type=checkbox]").prop("disabled",true);

           $("input[name=editorg]").on("click",function(){

                   $("input[name=org_name],input[name=rep_name],input[name=residential_address],input[name=email_address]").removeAttr("disabled");
           })

           $("input[name=updateorg]").on("click",function(){

               $("input[name=org_name],input[name=rep_name],input[name=residential_address],input[name=email_address]").prop("disabled",true);
           })


       })
      </script>
</div>
