<?php


    // importing files
    $path = preg_replace('/wp-content.*$/','',__DIR__);
    require_once('../assests/SimpleXLSX.php');
    require_once($path.'wp-load.php');
    include('database.php');
    // include('matchingf.php');

    // if(function_exists('replaceText'))
    // {
    //     print_r("Database connected");
    // }




    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    

    // Checking if the page is working properly or not
    // echo "Hello there everything working fine";

    // Processing file
    if(isset($_POST['content_submitted']))
    {
      
        // File uploading set
        $target_dir_array =wp_upload_dir();
        $target_dir=$target_dir_array['path'];
        $target_file=$target_dir.basename($_FILES['excel_file']['name']);
        if(move_uploaded_file($_FILES['excel_file']['tmp_name'],$target_file))
        {
            if ( $xlsx = SimpleXLSX::parse($target_file) ) 
            {
             
                    $sheets=$xlsx->sheetNames();
                    // $number_of_rows=count($sheets);

                    foreach($sheets as $index => $name)
                    {



                        $aloo=$xlsx->rows($index);

                        // Checking File validity

                        if($aloo[0][0] == "First Name" && $aloo[0][1]== "Last Name" && $aloo[0][2] == "Email" && $aloo[0][3] == "Paypal Email" && $aloo[0][4] == "Street Address" && $aloo[0][5] == "City" && $aloo[0][6]== "State" && $aloo[0][7] == "Zip")
                        {
                            // File Processing Start


                            
                            
                            foreach ( $xlsx->rows($index) as $r => $row ) 
                            {
                                

                                if($row[0]=="First Name")
                                {

                                }

                                else
                                {
                                    // Checking if users already exists or not (Using Email)
                                    $users=userstable();
                                    $flag=true;


                                    // Fetching Data from the Document
                                    $content_to[0]=$row[0];
                                    $content_to[1]=$row[1];
                                    $content_to[2]=$row[2];
                                    $content_to[3]=$row[3];
                                    $content_to[4]=$row[4];
                                    $content_to[5]=$row[5];
                                    $content_to[6]=$row[6];
                                    $content_to[7]=$row[7];

                                    foreach($users as $indexx=> $user)
                                    {
                                        if($content_to[2] == $user->email)
                                        {
                                            echo "<br>";
                                            print_r("Email:".$content_to[2]. " already exists so skipped");
                                            echo "<br>";
                                            $flag=false;
                                        }

                                        
                                    }

                                    
                                    if($flag)
                                    {
                                        // Getting Previous Data
                                        // echo "<br>";
                                        // print_r("Data loaded ");
                                        // echo "<br>";
                                        // $data=generateData();

                                        if($content_to[0] == "" || $content_to[1]==""|| $content_to[2]==""||$content_to[3]==""||$content_to[4]==""||$content_to[5]==""||$content_to[6]==""||$content_to[7] =="")
                                        {
                                            echo "<br>";
                                            print_r("Details not complete for: ".$content_to[2]);
                                            echo "<br>";
                                            echo "<br>";
                                        }
                                      
                                        else
                                        {
                                            echo "<br>";
                                            print_r("Loading details for" .$content_to[2]);
                                            echo "<br>";
                                            insertUser($content_to);
                                            print_r("Insertion Completed");

                                        }




                                        // Storing data

                                        

                                        // print_r($checking_data);

                                        // $nani=json_decode($checking_data);

                                        // echo '<pre>';
                                        // print_r($nani);
                                        // echo '</pre>';




                                    }
                                }

                       
                            }
                        }

                        else 
                        {
                            echo "<br>Invalid Data Please use offical sheet for data insertion<br>";
                        }
                        

                    }

              } else 
              {
                echo SimpleXLSX::parseError();
              }
        }

        else
        {
            echo "Error ha beta";        
        }

    }



?>