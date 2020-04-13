<?php
    if(isset($_POST['create_file']))
        {
          $fil=$_POST['fil'];
          //$folder="files/";
          $ext=".txt";
        $fil=$fil."".$ext;
        $create_file = fopen($fil, 'w');
        fclose($create_file);
        }

    if (isset($_POST["submit"])) {     
            $filename = $_FILES["uploadfile"]["name"]; 
            session_start();    
            $_SESSION['filename1'] = $filename; 
            move_uploaded_file($_FILES["uploadfile"]["tmp_name"] , $_FILES["uploadfile"]["name"]);
    
            $file = fopen($filename , "r");
        }
    if( isset ($_POST["changes"])){
            session_start();
            $filename = $_SESSION['filename1'];

            $file = fopen($filename , "w");
            $str = $_POST["textarea1"];
            $_SESSION['str'] = $str;
           
            fwrite($file,$str);
        }
    if(isset ($_POST['search']) ){
            session_start();
            $str= $_SESSION['str'];
          
            $search = $_POST['searchtext'];
            $x = strpos($str,$search);
          
            if(($x !== false)  )
                echo "index is ".$x." for first occurence of ".$search ."<br>";
            else
                echo $search. " is not found.<br>";
        }
     if(isset($_POST['edit_file']))
       {
        $file=$_POST['file'];
        $write_text=$_POST['edit_text'];
        $ext=".txt";
        $file=$file."".$ext;
        $edit_file = fopen($file, 'a+');
        fwrite($edit_file, $write_text);
        fclose($edit_file);
       }
       if(isset($_POST['delete_file']))
         {
             $file_name=$_POST['file_name'];
             $ext=".txt";
            $file_name=$file_name."".$ext;
            unlink($file_name);
        }

?>
<!doctype html>
<html>
<fieldset>
    <head>
        <title>Assignment:03</title>
        <style>
            body{
                background-color: skyblue;
            };
        table,td,tr{
            padding: 10px;
            margin:10px;
        };
        </style>
    </head>
	
    <body class="p-3 mb-2 bg-info text-white" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <center>
        <h1 style="color:yellow"><i>*file Handler*</i></h1>
		
        <form action="" name="form1"method="POST" enctype="multipart/form-data">
            <table>
                <tr style="padding:30px">
			
				<input type="submit" value="Create File" name="create_file"class="btn btn-warning"><br\>
                    <input type="text" name="fil"><br>
           <input type="file" name="uploadfile" id="choose" class="btn btn-primary">
					
                    
                </tr>
                <tr>
                    <td><input type="submit" id="submit" name="submit" value="Upload File" class="btn btn-info"></td>
                    <td style="padding:10px;margin-right: 10px"><input type="reset" value="Reset file"  class="btn btn-info"></td>
                </tr>
                
            </table>
            <textarea rows="14" cols="55" name="textarea1" class="file"  >
                <?php
                    if (isset($_POST["submit"])){
                        while (! feof($file))
                        {
                            echo fgets($file);
                        }
                    }
                ?>
            </textarea> <br>
            <table>
     <tr>
    <input type="submit" name="changes" value="Save Changes"  class="btn btn-warning"> 
	</tr>
    <tr><td><center>
	<input type="submit" name="search" value="Search Text"  class="btn btn-success">
	<input type="text" name="searchtext" class="file"></center></td>
</tr>
    <tr><td>
    
   
    <input type="submit" value="append" name="edit_file"class="btn btn-primary"> 
<input type="text" name="file">
 <textarea name="edit_text"rows="1" cols="20"></textarea>	</td></tr>
    <tr><td>
   <input type="submit" value="Delete File" name="delete_file"class="btn btn-danger">
<input type="text" name="file_name">   </td></tr>
            
           </table> 
        </form>
      </center>
    </body>


    </fieldset>
</html>