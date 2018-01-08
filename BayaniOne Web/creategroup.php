<script type="text/javascript">
  window.onload = function(){
      document.getElementById('close').onclick = function(){
          this.parentNode.parentNode.parentNode
          .removeChild(this.parentNode.parentNode);
          return false;
      };
  };
</script>

    <a href="home.php"><span id='close'>x</span></a>
  <form id="create_group" name="create_group" action="home.php" method="post">
    <h2>Create Group</h2>
    </br>
    <fieldset>
      <?php
      //code to get the user_id that is used in inserting record in post table
        $connect=mysqli_connect("localhost","root","","bayanione_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($connect,"SELECT user_id FROM users WHERE username = '".$_SESSION['username']."'");
        while($row = mysqli_fetch_assoc($result))
        {
          echo "<input type=hidden name='user_id' id='user_id' value =" . $row['user_id']. ">";
        }
        mysqli_close($connect);
      ?>
      <input type="text" id="group_name" name="group_name" placeholder="Group name" value=""/>
      </br>
      </br>
      <img id="group_image" name="group_image" runat="server" height="150" width="150"/>
      <input type="file" id="group_logo" name="group_logo" accept="image/*" onchange="READURL(this);"/>
      <!-- script to display image on select -->
      <script>
        //script code to display photo during selection
        function READURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#group_image')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(150);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
        }
      </script>
      </br>
      <textarea name="group_description" rows="7" cols="64" style="text-align:left;resize:none;" placeholder=".........Write Someting........"></textarea>
      </br>
      <label>Admin:</label>
      <?php
      //code to get the user_id that is used in inserting record in post table
        $connect=mysqli_connect("localhost","root","","bayanione_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($connect,"SELECT username FROM users WHERE username = '".$_SESSION['username']."'");
        while($row = mysqli_fetch_assoc($result))
        {
          echo "<input type='text' name='admin' id='admin' value =" . $row['username']. ">";
        }
        mysqli_close($connect);
      ?>
      &nbsp;&nbsp;
      <label>Add Members:</label>
      <?php
      //code to get the user_id that is used in inserting record in post table
        $connect=mysqli_connect("localhost","root","","bayanione_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($connect,"SELECT username FROM users");
        echo "<select name='members' id='members' value=''>";
        echo "<option value =''>" .'choose username..'. "</option>";
        while($row = mysqli_fetch_assoc($result))
          {
            echo "<option value =" . $row['username']. ">" .$row['username']. "</option>";
          }
          echo "<select>";
        mysqli_close($connect);
      ?>
    </br>
    </br>
    <input class="btnlogin" type="submit" id="post_group" name="post_group" value="Create"/>
  </fieldset>
  </form>

  <?php include 'databaseconn.php' ?>
  <?php
    //code to insert record in post table
    if(isset($_POST['post_group']))
    {
      //variables
      $user_id = $_POST['user_id'];
      $group_logo = $_POST['group_logo'];
      $group_name = $_POST['group_name'];
      $group_description = $_POST['group_description'];
      $admin = $_POST['admin'];
      $members = $_POST['members'];
      $create_date= $_POST['create_date'];

      if(isset($_FILES['group_logo'])) {
        $group_logo=addslashes(file_get_contents($_FILES['group_logo']['temp_name'])); //will store the image to fp
      }
      //query to insert data
      if($group_logo!='' && $group_name!='' && $group_description!='')
      {
      mysqli_query($connect, "INSERT INTO groups (user_id,group_logo,group_name,group_description,admin,members,create_date)
                  VALUES('$user_id','$group_logo','$group_name','$group_description','$admin','$members',NOW())");
                  if(mysqli_affected_rows($connect) > 0){
                  echo "      ";
                }else {
                  echo mysqli_error($connect);
                  echo "Not Added!";
                }
      }
        echo "<meta http-equiv='refresh' content='0'>";
    }
  ?>
