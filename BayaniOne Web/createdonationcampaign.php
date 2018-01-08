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
  <form id="create_campaign" name="create_campaign" action="home.php" method="post">
    <h2>Donation Campaign Post</h2>
    </br>
    <fieldset>
      <?php
        //code to get user_id
        $connect=mysqli_connect("localhost","root","","bayanione_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $result = mysqli_query($connect,"SELECT MAX(post_id) FROM post GROUP BY post_id");
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            $next = $row['MAX(post_id)'] + 1;
          }
            echo "<input value='". $next ."' type='hidden' name='post_id' id='post_id'>";
            echo "</input>";
        }
        mysqli_close($connect);
      ?>
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
          echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
        }
        mysqli_close($connect);
      ?>
    </br>
    <input type="hidden" id="create_date" name="create_date"/>
    <input type="hidden" id="post_type" name="post_type" value="donation campaign"/>
    <select class="input" id="post_status" name="post_status" value="" Height="22px" Width="187px" requireds>
        <option value="">where to post?</option>
        <option value="public">Public</option>
        <option value="timeline">Timeline</option>
    </select>
    <?php
    //code to get the user_id that is used in inserting record in post table
      $connect=mysqli_connect("localhost","root","","bayanione_db");
      // Check connection
      if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $result = mysqli_query($connect,"SELECT username FROM users");
      echo "<select name='tag_user' id='tag_user' value=''>";
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
    <img id="post_image" name="post_image" runat="server" height="150" width="150"/>
    <input type="file" id="campaign_photo" name="campaign_photo" accept="image/*" onchange="readURL(this);"/>
    <!-- script to display image on select -->
    <script>
      //script code to display photo during selection
      function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      $('#post_image')
                          .attr('src', e.target.result)
                          .width(150)
                          .height(150);
                  };
                  reader.readAsDataURL(input.files[0]);
              }
      }
    </script>
    </br>
    <textarea name="campaign_description" rows="7" cols="64" style="text-align:left;resize:none;" placeholder=".........Write Someting........"></textarea>
    <input class="btnlogin" type="submit" id="post_campaign" name="post_campaign" value="Post"/>
  </fieldset>
  </form>

  <?php include 'databaseconn.php' ?>
  <?php
    //code to insert record in post table
    if(isset($_POST['post_campaign']))
    {
      //variables
      $user_id = $_POST['user_id'];
      $post_id = $_POST['post_id'];
      $post_type = $_POST['post_type'];
      $post_status = $_POST['post_status'];
      $create_date= $_POST['create_date'];
      $tag_user = $_POST['tag_user'];
      $campaign_description = $_POST['campaign_description'];
      $campaign_photo = $_POST['campaign_photo'];

      if(isset($_FILES['campaign_photo'])) {
        $campaign_photo=addslashes(file_get_contents($_FILES['campaign_photo']['temp_name'])); //will store the image to fp
      }
      //query to insert data
      if($post_status!='')
      {
      mysqli_query($connect, "INSERT INTO post (user_id,post_type,post_status,create_date,tag_user)
                  VALUES('$user_id','$post_type','$post_status',NOW(),'$tag_user')");
                  if(mysqli_affected_rows($connect) > 0){
                  echo "      ";
                }else {
                  echo mysqli_error($connect);
                  echo "Not Added!";
                }
      }
            if($post_type='donation campaign')
            {
                mysqli_query($connect, "INSERT INTO donation_campaign (post_id,campaign_description,campaign_photo)
                            VALUES('$post_id','$campaign_description','$campaign_photo')");
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
</div>
