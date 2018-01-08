<div>
  <?php
    //code to diplays post, comment, and insert comment for individual user
    $connect=mysqli_connect("localhost","root","","bayanione_db");
    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //code to display posts

    $result_donation_post = mysqli_query($connect,"SELECT * FROM post LEFT JOIN users ON post.user_id=users.user_id LEFT JOIN individual_user ON users.user_id=individual_user.user_id WHERE post.post_status='public'");
    if($result_donation_post)
    {
      foreach($result_donation_post as $post)
          //while($row = mysqli_fetch_assoc($result))
          {
                echo "<div style='background-color: #C6C6C6;'>";
                  echo "<table>";
                    echo "<tbody>";
                      echo "<tr>";
                        echo "<td>";
                          echo "<input type=hidden name='post_id' id='post_id' value =" . $post['post_id']. ">";
                        echo "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . $post['post_type'] . ' | ' . $post['first_name'] . '  ' . $post['middle_name'] . ' ' . $post['last_name'] . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>" . $post['create_date'] . "</td>";
                        echo "<td>" . $post['tag_user'] . "</td>";
                      echo "</tr>";
                      $result_post1 = mysqli_query($connect,"SELECT * FROM donation_campaign INNER JOIN post ON donation_campaign.post_id=post.post_id WHERE post.post_status='public'");
                      foreach($result_post1 as $post1)
                          //while($row = mysqli_fetch_assoc($result))
                          {
                      echo "<tr>";
                        echo "<td>" . $post1['campaign_description'] . "</td>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<td>";
                          echo "<img src='Uploads/",$post1['campaign_photo'],"' width='175' height='200' />";
                        echo "</td>";
                      echo "</tr>";
                    echo "</tbody>";
                  echo "</table>";

                  //code to display comments
                  $result_comment = mysqli_query($connect,"SELECT comment_content, comment_date, first_name, middle_name, last_name FROM post_comment LEFT JOIN users ON post_comment.user_id=users.user_id LEFT JOIN individual_user ON users.user_id=individual_user.user_id WHERE post_id=". $row['post_id']."");
                  if($result_comment)
                  {
                    foreach($result_comment as $comment)
                  //while($row3 = mysqli_fetch_assoc($result_comment))
                    {
                    echo "<div>";
                      echo "<table>";
                        echo "<tbody>";
                          echo "<tr>";
                            echo "<td>" . $comment['first_name'] . '  ' . $comment['middle_name'] . ' ' . $comment['last_name'] . "</td>";
                          echo "</tr>";
                          echo "<tr>";
                            echo "<td>" . $comment['comment_date'] . "</td>";
                          echo "</tr>";
                          echo "<tr>";
                            echo "<td>" . $comment['comment_content'] . "</td>";
                          echo "</tr>";
                        echo "</tbody>";
                      echo "</table>";
                      echo "</div>";
                    }
                }

                  //code to create comment
                      echo "<form class='modal-content animate' id='create_comment' name='create_comment' action='home.php' method='post'>";
                        echo "<fieldset>";
                            echo "<input type=hidden name='post_id' id='post_id' value =" . $row['post_id']. ">";
                            echo "<input type=hidden name='user_id' id='user_id' value =" .$row['user_id'] . ">";
                          echo "<textarea name='comment_content' id='comment_content' rows='1' cols='50' style='text-align:left;' placeholder='Write A Comment........'>" . "</textarea>";
                          echo "<input type='submit' id='commment_status' name='comment_status' value='Comment'/>";
                        echo "</fieldset>";
                      echo "</form>";

            echo "<div style='background-color: #ffffff;'>";
              echo "</br>";
            echo "</div>";
      }
    }
  }
    mysqli_close($connect);
  ?>

</div>
