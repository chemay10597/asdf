<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form name='' id='' action='' method='post'>
        <input type='text' name='txt_category' id='category' value='$category' disabled>
        <input type='text' name='txt_stage' id='stage' value='$stage' disabled>
        <select disabled>
            <option>I am Option 1</option>
             <option>I am Option 2</option>
        </select>
        <input type='checkbox' name='txt_approve' id='approve' value='$approve' disabled>
        <input type="button" name='edit' value='edit'>
        <input type="button" name='save' value='save'>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>

     $(document).ready(function(){

         $("form input[type=text],form input[type=checkbox]").prop("disabled",true);

         $("input[name=edit]").on("click",function(){

                 $("input[type=text],input[type=checkbox],select").removeAttr("disabled");
         })

         $("input[name=save]").on("click",function(){

             $("input[type=text],input[type=checkbox],select").prop("disabled",true);
         })


     })
    </script>
</body>
</html>
