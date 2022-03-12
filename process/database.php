<?php


function userstable()
{
    global $wpdb;

    $usertable=$wpdb->prefix.'amelia_users';
    $data= $wpdb->get_results("SELECT email FROM ".$usertable);
    return $data;
}

function insertUser($content)
{
    global $wpdb;

    $usertable=$wpdb->prefix.'amelia_users';
    $data = array('status' => 'visible', 'type' => 'admin','firstName'=>$content[0],'lastName'=>$content[1],'email'=>$content[2]);
    $format = array('%s');
    $wpdb->insert($usertable,$data,$format);

    if($wpdb->last_error !== '') :

        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );

        print "<div id='error'>
        <p class='wpdberror'><strong>WordPress database error:</strong> [$str]<br />
        <code>$query</code></p>
        </div>";

    endif;
    // $wpdb->show_errors();
    $my_id = $wpdb->insert_id;

    // echo "Id is";
    // print_r($my_id);




    // Processing Info

    $info->firstName=$content[0];
    $info->lastName=$content[1];
    $info->phone=null;

    $info=json_encode($info);

    // Processing Custom Fields


    $cf[1]->label="Street Address";
    $cf[1]->value=$content[4];
    $cf[1]->type="text";

    $cf[3]->label="City";
    $cf[3]->value=$content[5];
    $cf[3]->type="text";

    $cf[4]->label="State";
    $cf[4]->value=$content[6];
    $cf[4]->type="text";

    $cf[5]->label="Zip Code";
    $cf[5]->value=$content[7];
    $cf[5]->type="text";

    $cf[6]->label="Paypal Email";
    $cf[6]->value=$content[3];
    $cf[6]->type="text";

    $objectt=json_encode($cf);










    $nextTable=$wpdb->prefix.'amelia_customer_bookings';
    $nextData=array('customerId'=>$my_id,'status'=>'approved','price'=>0,'persons'=>1,'customFields'=>$objectt,'info'=>$info);
    $nextformat = array('%d','%s','%d','%d','%s','%s');
    $wpdb->insert($nextTable,$nextData,$nextformat);




}


function generateData()
{
    global $wpdb;


    $nextTable=$wpdb->prefix.'amelia_customer_bookings';
    $data= $wpdb->get_results("SELECT customFields FROM ".$nextTable);

    return $data;
    
}


?>