<?php
    include 'connection.php';
    
    
// START OF FUNCTIONS - START OF FUNCTIONS - START OF FUNCTIONS
    
    
// Version of the app
        function versionControl(){
                ?>
                <div align='right'>
                <font size='3' color='red'>v2.4 - 28/April/2020</font>
                </div>
                <?php
        }
    
    
    
    
    
// Price Notice
        function priceNotice(){
                ?>
                <div align="center"><font size="2">
                <i><b>PRICE NOTICE: </b>The price quoted is an approximation. The final price will be discussed with you with the pub's manager when they contact you to finalise payment.</font>
                </div>  
                <?php
        }
        
        
    
// GDPR Notice
        function gdprNotice(){
                ?>
                <div align="center">
                <font size="2"><i><b>GDPR NOTICE:</b> By clicking submit, you the customer are agreeing to your information being sent to King Henrys Taverns to be able to process your order. Your information will not be used for any other purpose.</i></font>
                </div>
                <?php
        }
            
            

    
//  configmation of order
        function confirmationOfOrder(){
                global $mysqli;
                global $full_name;
                
                echo "<div align='center'>
                <font size='8'><i>$full_name, your shopping list was successfully submitted.</i></font>
                <br><font size='5'><i>A member of the pub staff will contact you within 24 hours to confirm your order, check stock levels and complete payment of $total_amount.</i></font>
                <br>
                <br><a href='index.php'>Back to the order page.</a>
                <br>
                <br><a href='http://www.king-henrys-taverns.co.uk'>Back to the main page.</a>
                </div>";
        }
    
    
    
    
// adding real escape string to the variables to prevent hackers
        function escapeStringVar(){
                 global $mysqli;
                 global $id;
                 global $full_name;
                 global $email_from;
                 global $telephone;
                 global $door;
                 global $postcode;
                 global $pub;
                 global $deliverycollection;
                 global $total_amount;
                 global $notess;
                 $id = mysqli_real_escape_string($mysqli, $id);
                 $full_name = mysqli_real_escape_string($mysqli, $full_name);
                 $email_from = mysqli_real_escape_string($mysqli, $email_from);
                 $telephone = mysqli_real_escape_string($mysqli, $telephone);
                 $door = mysqli_real_escape_string($mysqli, $door);
                 $postcode = mysqli_real_escape_string($mysqli, $postcode);
                 $pub = mysqli_real_escape_string($mysqli, $pub);
                 $deliverycollection = mysqli_real_escape_string($mysqli, $deliverycollection);
                 $total_amount = mysqli_real_escape_string($mysqli, $total_amount);
                 $notess = mysqli_real_escape_string($mysqli, $notess); 
        }
                
    
// inster submitted data into the ORDERS table in MySQL    
        function sqlInsertInToOrders(){
                global $mysqli; 
                global $sql; 
                global $full_name; 
                global $telephone; 
                global $door; 
                global $postcode; 
                global $pub; 
                global $total_amount; 
                global $productss; 
                global $notess;
                $sql = "INSERT INTO orders (fullName, contact, address, pub, total_amount, custorder, notes) VALUES ('".$full_name."','".$telephone."','".$door. ' - ' .$postcode."','".$pub."','".$total_amount."','".$productss."','".$notess."')";
                $mysqli->query($sql);
        }
            


// attempt to try and no send any emails if they contain blank data
        function killIfNoName(){
                global $mysqli;
                global $full_name;
                if (empty($full_name)){
                header('Location: http://www.king-henrys-taverns.co.uk');
                die();
                }
        }
            





// attempt to change total amount in the email if equals 0.00
        function killIfZero(){
                global $mysqli;
                global $total_amount;
                if($total_amount == 0.00)
                {
                    $total_amount = "TBC";
                }

        }





    
// menu that goes inbetween each food section for desktop and differs the mobile ver
        function jumpToMenu(){
                echo 'Jump to : <font color="black"><div class="mobile"><table width="100%" padding="20px"><tr><a href="#butcherscorner"><i class="fas fa-hat-cowboy"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#moremeat"><i class="fas fa-bacon"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#chicken"><i class="fas fa-drumstick-bite"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#frozen"><i class="far fa-snowflake"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#fruitnveg"><i class="fas fa-apple-alt"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#other"><i class="fas fa-toilet-paper"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#snacks"><i class="fas fa-cookie-bite"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#alcohol"><i class="fas fa-wine-bottle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#checkout"><i class="fas fa-shopping-basket"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr></table></div></font>';
                echo '<font color="black"></font><div class="desktop"><table width="100%" padding="20px"><tr><a href="#butcherscorner">Butchers Corner <i class="fas fa-hat-cowboy"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#moremeat">More Meat <i class="fas fa-bacon"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#chicken">Chicken <i class="fas fa-drumstick-bite"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#frozen">Frozen Goods <i class="far fa-snowflake"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#fruitnveg">Fruit & Veg <i class="fas fa-apple-alt"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#other">Other <i class="fas fa-toilet-paper"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#snacks">Snacks <i class="fas fa-cookie-bite"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#alcohol">Alcohol <i class="fas fa-wine-bottle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr><tr><a href="#checkout">Checkout <i class="fas fa-shopping-basket"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</tr></table></div></font>';              
        }
    
    
    
    
// the variable $pub should contain the pubs email from a POST in the index, this is then converted to its full name where needed.
        function convertEmailToName(){
                global $mysqli;
                global $pub;
                global $pubName;
                $pubName = "";
                if ($pub == "lionle16@aol.com") {$pubName = "Old Red Lion";}
                elseif ($pub == "khthoneybee@aol.com") {$pubName = "Honey Bee";}
                elseif ($pub == "cedarsle56dn@aol.com") {$pubName = "Cedars";}
                elseif ($pub == "ragleyde737fy@aol.co.uk") {$pubName = "Ragley";}
                elseif ($pub == "manle174sb@aol.com") {$pubName = "Man At Arms";}
                elseif ($pub == "smithycv239ef@aol.com") {$pubName = "Old Smithy";}
                elseif ($pub == "nowayofknowing@hotmail.co.uk") {$pubName = "Management";}
                elseif ($pub == "bleemster@hotmail.com") {$pubName = "Developer Testing";}
                else {echo "KHT";}
        }
    
    
    
// SQL queries    
        function butchersSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Steaks' ORDER BY item"));
        }
    
        function moreMeatSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'More Meat' ORDER BY item"));
        }
    
        function chickenSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Chicken' ORDER BY item"));
        }
    
        function frozenSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Frozen Goods' ORDER BY item"));
        }
            
        function fruitSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Fruit and Veg' ORDER BY item"));
        }            
            
        function otherSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Other Things' ORDER BY item"));
        }                  

        function snacksSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Snacks' ORDER BY item"));
        }   
            
        function beersSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Beers and Ciders' ORDER BY item"));
        }               
            
        function fortifiedWinesSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Fortified Wines' ORDER BY item"));
        }             
            
        function liqueursSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Liqueurs' ORDER BY item"));
        }                
            
        function softDrinksSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Soft Drinks' ORDER BY item"));
        }                 
            
        function spiritsSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Spirits' ORDER BY item"));
        }              
            
        function winesSqlQuery(){
                global $mysqli;
                global $result;
                    // get the records from the database
                    if ($result = $mysqli->query("SELECT * FROM products WHERE catagory = 'Wines' ORDER BY item"));
        }              
    
        
        
        
// the commone table data that follows the unique SQL query for each menu catagory        
        function menuUniversalPart(){
                global $mysqli;
                global $result;
                    {
                    // display records if there are records to display
                    if ($result->num_rows > 0)
                        {
                        // display records in a table
                        echo "<div class='col-lg-12'><div class='table-responsive' align='center'><table class='table table-striped'>";
                        // set table headers
                        echo "<tr>
                        <th></th><th width='600'>ITEM</th><th>COST</th><th>SIZE</th><th>QTY</th></tr>";
                        while ($row = $result->fetch_object())
                            {
                                // set up a row for each record
                                echo "<tr>";
                                // echo "<td>" . $row->id . "</td>";
                                echo "<td></td>";
                                echo "<td>" . $row->item . "</td>";
                                echo "<td>£ " . $row->cost . "</td>";
                                echo "<td>" . $row->size . "</td>";
                                // echo "<td>" . $row->catagory . "</td>";
                                echo "<td><input type='number' onkeyup='numOnly(this)' min='0' max='99' id='itemselected' name='".$row->id."'></td>";
                                echo "</tr>";
                            }
                            echo "</table></div></div>";
                        }
                        // if there are no records in the database, display an alert message
                        else
                            {
                            echo "No results to display!";
                            }
                    }
        }
    
    
    
    
    
// I CANT REMEMBER WHAT THIS IS
        function displayIndexTable(){
                                {
                // display records if there are records to display
                if ($result->num_rows > 0)
                {
                // display records in a table
                echo "<div class='col-lg-12'><div class='table-responsive' align='center'><table class='table table-striped'>";
                // set table headers
                echo "<tr><th></th><th width='600'>ITEM</th><th>COST</th><th>SIZE</th><th>QTY</th></tr>";
                while ($row = $result->fetch_object())
                {
                // set up a row for each record
                echo "<tr>";
                // echo "<td>" . $row->id . "</td>";
                echo "<td></td>";
                echo "<td>" . $row->item . "</td>";
                echo "<td>£ " . $row->cost . "</td>";
                echo "<td>" . $row->size . "</td>";
                // echo "<td>" . $row->catagory . "</td>";
                echo "<td><input type='number' min='0' max='99' id='itemselected' name='".$row->id."'></td>";
                echo "</tr>";
                }
                echo "</table></div></div>";
                }
                // if there are no records in the database, display an alert message
                else
                {
                echo "No results to display!";
                }
                }
        }
    
    
    
    
    
    
// email to subject etc and putting the data into variables to get ready to send
        function mainEmailBody(){
                global $mysqli;
                global $pub;
                global $pubName;
                global $deliverycollection;
                global $total_amount;
                global $productss;
                global $row;
                global $to;
                global $subject;
                global $result;
                global $count;
                $to = $pub;
                $subject = "$pubName - " . $deliverycollection . " - " . $total_amount; 
                $productss = '';
                if ($result = $mysqli->query("SELECT * FROM products"))
                    {
                    // display records if there are records to display
                    if ($result->num_rows > 0)
                        {
                        $count=1;
                        while ($row = $result->fetch_object())
                            {
                            if(isset($_POST[$row->id]) && $_POST[$row->id]>0)
                                {
                                $productss .= "<tr><td>".$count."</td><td>".$row->item."</td><td>".$row->size."</td><td>".$_POST[$row->id]."</td></tr>";
                                $count++;
                                }
                           }
                        }
                    }
        }
 
 
 
 
// email headers
        function emailHeaderSettings(){
                global $mysqli;
                global $headers;
                global $email_from;
                global $to;
                global $subject;
                global $message;
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: King Henrys Taverns<kinghenrytaverns@theeasypc.co.uk>' . "\r\n";
                // $headers .= 'Cc:'.$email_from . "\r\n";
                $headers .= 'BCc: bleemster@hotmail.com' . "\r\n";
                // $headers .= 'BCc: nowayofknowing@hotmail.co.uk' . "\r\n";
                mail($to,$subject,$message,$headers);
        }
            
    

// email main body
        function emailBody(){
                global $mysqli; 
                global $message; 
                global $full_name; 
                global $email_from;
                global $telephone;
                global $door;
                global $postcode;
                global $pub;
                global $total_amount;
                global $notess;
                global $productss;
                global $deliverycollection;
                global $pubName;
                $message = "
                <html>
                <head>
                <title>HTML email</title>
                <style>
                table, td, th 
                {  
                  border: 1px solid #ddd;
                  text-align: left;
                }
                table 
                {
                  border-collapse: collapse;
                  width: 100%;
                }
                th, td 
                {
                  padding: 15px;
                }
                </style>
                </head>
                <body>
                <h3>Customer Information</h3>
                <label><font color='red'>Full Name: </font></label>".$full_name."<br>
                <label><font color='red'>Email: </font></label>".$email_from."<br>
                <label><font color='red'>Phone: </font></label>".$telephone."<br>
                <label><font color='red'>Door: </font></label>".$door." - ".$postcode."<br>
                <label><font color='red'>Pub: </font></label>".$pubName."
                <h4><font color='blue'>".$deliverycollection." - ".$total_amount."*</font></h4>
                <h4>Customer notes:</h4>
                <i><font color='red'>".$notess."</font></i>
                <h4>Order Details</h4>
                <table>
                <thead>
                <tr>
                <th>#</th>
                <th>Product</th>
                <th>Size</th>
                <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                ".$productss."
                </tbody>
                </table>
                </body>
                </html>
                ";
        }

// END OF FUNCTIONS - END OF FUNCTIONS - END OF FUNCTIONS - END OF FUNCTIONS
?>
    
  