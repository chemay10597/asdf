<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

    include_once("header.php");
    //session_start();
    if(!isset($_SESSION["username"])){
        header("location:index.php");
    } else {
?>
<?php include 'databaseconn.php' ?>

  <body style="background-color: #ffffff;">
      <div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class = "navbar-brand" href="home.php"><span><image src = "../images/logo.png" height= "50px" width="50px"></span><span><image src = "../images/logotext.png" id="logotext" height= "50px" width="200px"></span></a>
              <!-- <a class="navbar-brand" href="index.html">BayaniOne<span>.</span></a> -->
              </div>

              <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav navbar-right">
                  <input class="form-control" type="text" style="width:100%; position:bottom;" placeholder="Search for...">
                  <li>
                    <a href= "#viewmap">View Map</a>
                  </li>
                  <li>
                    <div class="dropdown">
                      <button class="dropbtn">Community Updates</button>
                      <div class="dropdown-content" id="nav">
                        <a href="#publicupdate">Public Update</a>
                        <a href="#privateupdate">Private Update</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <!--<a href="#mygroup">My Group</a>-->
                    <div class="dropdown">
                      <button class="dropbtn">My Group</button>
                      <div class="dropdown-content" id="nav">
                        <a href="#creategroup">Create Group</a>
                        <?php
                        //code to get the user_id that is used in inserting record in post table
                          $connect=mysqli_connect("localhost","root","","bayanione_db");
                          // Check connection
                          if (mysqli_connect_errno())
                          {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }

                          $result = mysqli_query($connect,"SELECT group_name FROM groups INNER JOIN users ON groups.user_id=users.user_id WHERE username='". $_SESSION["username"] ."'");
                            while($row = mysqli_fetch_array($result))
                            {
                              echo "<a href='#group_profile'>". $row['group_name'] ."</a>";
                            }
                          mysqli_close($connect);
                        ?>
                      </div>
                  </li>
                  <li>
                    <!--<a href= "#posts">Post</a>-->
                    <div class="dropdown">
                      <button class="dropbtn">Post</button>
                      <div class="dropdown-content" id="nav">
                        <a href="#donationcampaign">DonationCampaign</a>
                        <a href="#testimonies">Testimonies</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown">
                      <button class="dropbtn">
                        <?php
                        //code to get the user_id that is used in inserting record in post table
                          $connect=mysqli_connect("localhost","root","","bayanione_db");
                          // Check connection
                          if (mysqli_connect_errno())
                          {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }

                          $result = mysqli_query($connect,"SELECT username FROM users WHERE username='". $_SESSION["username"] ."'");
                            while($row = mysqli_fetch_array($result))
                            {
                              echo $row['username'];
                            }
                          mysqli_close($connect);
                        ?>

                      </button>
                        <div class="dropdown-content" id="nav">
                          <a href="#accountsetting">AccountSetting</a>
                        </div>
                    </div>
                  </li>
                  <li>
                    <a class="btn-logout" href= "logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <center><div class="scroll">
          <div id="publicupdate" class="displaydiv" style="display:none;">
            <?php //include_once("publicpost.php");?>
          </div>
          <div id="creategroup" class="displaydiv" style="display:none;">
            <?php //include_once("creategroup.php");?>
          </div>
          <div id="donationcampaign" class="displaydiv" style="display:none;">
            <?php //include_once("createdonationcampaign.php");?>
          </div>
          <div id="testimonies" class="displaydiv" style="display:none;">
            <?php //include_once("createtestimonies.php");?>
          </div>
          <div id="accountsetting" class="displaydiv" style="display:none;">
            <h3>User Info</h3>
             <?php //include_once("userinfo.php");?>
          </div>
          <?php include_once("newsfeed.php");?>
        </div></center>
        <script>
          $("#nav a").click(function(e){
            e.preventDefault();
            $(".toggle").hide();
            var toShow = $(this).attr('href');
            $(toShow).show();
          });
          //window.location.reload();.
        </script>
      </div>
    </div>
    <div class="homefooter">
    </br>
      <div class="social-networks">
          <a href="https://twitter.com" class="twitter"><img src="/images/twitterIcon.jpg" alt="" class="img-thumbnail img-circle"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="https://facebook.com" class="facebook"><img src="/images/facebookIcon.jpg" alt="" class="img-thumbnail img-circle"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="https://plus.google.com/" class="google"><img src="/images/googlePlusIcon.jpg" alt="" class="img-thumbnail img-circle"/></a>
      </div>
      <div class="footer-copyright">
          <p>© 2017 BayaniOne </p>
      </div>
    </br>
    </div>
</body>
<?php } ?>
</html>
