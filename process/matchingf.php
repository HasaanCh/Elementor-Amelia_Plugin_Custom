<?php

function replaceText($content,$id,$content_to)
{   
    // Fields check
    $text_element_identifier='text';
    $blurb_element_identifier='blurb';
    $testimonial_element_identifier='test';
    $accordion_element_identifier='acc';
    $number_counter_identifier='numc';
    $circle_counter_identifier='circ';
    $butt_identifier='butt';
    $tab_identifier='tab';


    // if($id == "" || $content_to="")
    // {
    //     $data=$content;
    // }

    // Redirecting to proper function
    if(strpos($id,$text_element_identifier) !== false)
    {
        $data=text_element($content,$id,$content_to);
    }
    else if(strpos($id,$blurb_element_identifier) !== false)
    {
        // print_r("Yes it's a blurb element");
        $data=blurb_element($content,$id,$content_to);
        
    }
    else if(strpos($id,$testimonial_element_identifier) !== false)
    {
        // print_r("Yes it's a testimonial element");
        $data=testi_element($content,$id,$content_to);
    }
    else if(strpos($id,$accordion_element_identifier) !== false)
    {
        $data=acc_element($content,$id,$content_to);
    }

    else if(strpos($id,$number_counter_identifier) !== false)
    {
        $data=numc($content,$id,$content_to);
    }
    else if(strpos($id,$circle_counter_identifier) !== false)
    {
        $data=circ($content,$id,$content_to);
    }
    else if(strpos($id,$circle_counter_identifier) !== false)
    {
        $data=circ($content,$id,$content_to);
    }
    else if(strpos($id,$butt_identifier) !== false)
    {
        $data=butt($content,$id,$content_to);
    }

    else if(strpos($id,$tab_identifier) !== false)
    {
        $data=tab_element($content,$id,$content_to);
    }
    else
    {
        $data=$content;
    }
    // Returning the final data
    return $data;
}

function text_element($content,$id,$content_to)
{
    // print_r("Hello i am in text element");
    $patternforwhole='/(?s)\[et_pb_text [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_text]/';
    $pattern='/(?<=\])(.*)(?=\[)/';

    // Matching using main pattern and Storing in Matches variable as array
    preg_match($patternforwhole, $content,$matches);
    // Converting to string
    $matches=implode("",$matches);
    // Replacing using the data 
    $replaced=preg_replace($pattern,$content_to,$matches);
    // Replacing whole block with new block
    $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    return $newreplaced;

}

function blurb_element($content,$id,$content_to)
{
    // print_r("Hello i am in blurb element");
    $matchforinner="title";
    if(strpos($id,$matchforinner) !== false)
    {
        // Replacing ID
        $id=str_replace('title','',$id);
        $patternforwhole='/(?s)\[et_pb_blurb [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_blurb]/';
        $pattern='/(?<=\])(.*)(?=\[)/s';
        preg_match($patternforwhole,$content,$matches);
        $matches=implode("",$matches);
        $pattern='/(?<=\btitle=")[^"]*/';
        $replaced=preg_replace($pattern,$content_to,$matches);
        $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    }

    else
    {
        $patternforwhole='/(?s)\[et_pb_blurb [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_blurb]/';
        $pattern='/(?<=\])(.*)(?=\[)/s';

        preg_match($patternforwhole,$content,$matches);
        $matches=implode("",$matches);
        $pattern='/(?<=\])(.*)(?=\[)/s';
            
        $replaced=preg_replace($pattern,$content_to,$matches);  
        $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    }
    
    return $newreplaced;
}

function testi_element($content,$id,$content_to)
{
    $matchfor_author="auth";
    $matchfor_job="job";
    $matchfor_comp="comp";

    if(strpos($id,$matchfor_author) !== false)
    {
        // Replacing ID
        $id=str_replace('auth','',$id);
        $patternforwhole='/(?s)\[et_pb_testimonial [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_testimonial]/';
        $pattern='/(?<=\])(.*)(?=\[)/s';
        preg_match($patternforwhole,$content,$matches);
        $matches=implode("",$matches);
        $pattern='/(?<=\bauthor=")[^"]*/';
        $replaced=preg_replace($pattern,$content_to,$matches);
        $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    }
    else if(strpos($id,$matchfor_job) !== false)
    {
        // Replacing ID
        $id=str_replace('job','',$id);
        $patternforwhole='/(?s)\[et_pb_testimonial [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_testimonial]/';
        $pattern='/(?<=\])(.*)(?=\[)/s';
        preg_match($patternforwhole,$content,$matches);
        $matches=implode("",$matches);
        $pattern='/(?<=\bjob_title=")[^"]*/';
        $replaced=preg_replace($pattern,$content_to,$matches);
        $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    }

    else  if(strpos($id,$matchfor_comp) !== false)
    {
        // Replacing ID
        $id=str_replace('comp','',$id);
        $patternforwhole='/(?s)\[et_pb_testimonial [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_testimonial]/';
        $pattern='/(?<=\])(.*)(?=\[)/s';
        preg_match($patternforwhole,$content,$matches);
        $matches=implode("",$matches);
        $pattern='/(?<=\bcompany_name=")[^"]*/';
        $replaced=preg_replace($pattern,$content_to,$matches);
        $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    }

    else
    {
        $patternforwhole='/(?s)\[et_pb_testimonial [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_testimonial]/';
        $pattern='/(?<=\])(.*)(?=\[)/s';

        preg_match($patternforwhole,$content,$matches);
        $matches=implode("",$matches);
        $pattern='/(?<=\])(.*)(?=\[)/s';
            
        $replaced=preg_replace($pattern,$content_to,$matches);  
        $newreplaced=preg_replace($patternforwhole,$replaced,$content);
    }
    
    return $newreplaced;
}

function acc_element($content,$id,$content_to)
{
    $patternforid = '/(.*?)inner/';
    preg_match($patternforid, $id, $idmatch, PREG_OFFSET_CAPTURE, 0);
    $main_id=$idmatch[1][0];

    // Getting Index
    $checkfortitle="title";
    $pt_title='/inner(.*)title/s';
    $pt_nontitle='/inner(.*)/s';
    
    if(strpos($id,$checkfortitle) !== false)
    {
        preg_match($pt_title, $id, $index_raw, PREG_OFFSET_CAPTURE, 0);
        $index=($index_raw[1][0]);
        
        $patternforchange='/(?<=\btitle=")[^"]*/';
    }
    else
    {
        preg_match($pt_nontitle, $id, $index_raw, PREG_OFFSET_CAPTURE, 0);
        $index=($index_raw[1][0]);
        // $patternforchange='/(?<=\btitle=")[^"]*/';
        $patternforchange='/(?<=\])(.*)(?=\[)/s';
    }
    $index=$index-1;

    $patternforwhole='/(?s)\[et_pb_accordion [^][]*module_id="'.$main_id.'"[^][]*].*?\[\/et_pb_accordion]/';
    preg_match_all($patternforwhole,$content,$matches);
    $aftercontent=$matches[0][0];
    $patternforinneritems = '/(\[et_pb_accordion_item.*?et_pb_accordion_item])/s';
    
    preg_match_all($patternforinneritems, $aftercontent, $chota, PREG_SET_ORDER, 0);
    $replaced=preg_replace($patternforchange,$content_to,$chota[$index][0]);
    // var_dump($replaced);
    $chota[$index][0]=$replaced;
    foreach($chota as $key=>$row)
    {
        $chota[$key][1]="";
    }

    $tmpArr = array();
    foreach ($chota as $sub) {
    $tmpArr[] = implode('', $sub);
    }
    $result = implode('', $tmpArr);
    // var_dump($result);
    // var_dump($aftercontent);
    $ptcc='/(?<=\])(.*?)(?=\[\/et_pb_accordion\])/s';
    $semi_final=preg_replace($ptcc,$result,$aftercontent,1);
    // var_dump($final);
    $final=preg_replace($patternforwhole,$semi_final,$content);
    return $final;
    
}

function  numc($content,$id,$content_to)
{
    $titletext='title';
    if(strpos($id,$titletext) !== false)
    {
        $pattern='/(?<=\btitle=")[^"]*/';
        $id=str_replace('title','',$id);
        $patternforwhole='/(?s)\[et_pb_number_counter [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_number_counter]/';   
    }

    else
    {
        $pattern='/(?<=\bnumber=")[^"]*/';
        $patternforwhole='/(?s)\[et_pb_number_counter [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_number_counter]/';
    }
    preg_match($patternforwhole,$content,$matches);

    $replace=preg_replace($pattern,$content_to,$matches);

    $replace=$replace[0];
    $final=preg_replace($patternforwhole,$replace,$content);
    return $final;

}

function  circ($content,$id,$content_to)
{
    $titletext='title';
    if(strpos($id,$titletext) !== false)
    {
        $pattern='/(?<=\btitle=")[^"]*/';
        $id=str_replace('title','',$id);
        $patternforwhole='/(?s)\[et_pb_circle_counter [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_circle_counter]/';   
    }

    else
    {
        $pattern='/(?<=\bnumber=")[^"]*/';
        $patternforwhole='/(?s)\[et_pb_circle_counter [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_circle_counter]/';
    }
    preg_match($patternforwhole,$content,$matches);

    $replace=preg_replace($pattern,$content_to,$matches);

    $replace=$replace[0];
    $final=preg_replace($patternforwhole,$replace,$content);
    return $final;

}


function  butt($content,$id,$content_to)
{
    $titletext='link';
    if(strpos($id,$titletext) !== false)
    {
        $id=str_replace('link','',$id);
        $pattern='/(?<=\bbutton_url=")[^"]*/';
       
    }

    else
    {
        $pattern='/(?<=\bbutton_text=")[^"]*/';
        
    }
    $patternforwhole='/(?s)\[et_pb_button [^][]*module_id="'.$id.'"[^][]*].*?\[\/et_pb_button]/';
    preg_match($patternforwhole,$content,$matches);

    $replace=preg_replace($pattern,$content_to,$matches);
    $replace=$replace[0];
    $final=preg_replace($patternforwhole,$replace,$content);
    return $final;

}



function tab_element($content,$id,$content_to)
{
    $patternforid = '/(.*?)inner/';
    preg_match($patternforid, $id, $idmatch, PREG_OFFSET_CAPTURE, 0);
    $main_id=$idmatch[1][0];

    // Getting Index
    $checkfortitle="title";
    $pt_title='/inner(.*)title/s';
    $pt_nontitle='/inner(.*)/s';
    
    if(strpos($id,$checkfortitle) !== false)
    {
        // print_r("I am title wala");
        preg_match($pt_title, $id, $index_raw, PREG_OFFSET_CAPTURE, 0);
        $index=($index_raw[1][0]);
        
        $patternforchange='/(?<=\btitle=")[^"]*/';
    }
    else
    {
        // print_r("I am text wala ");
        preg_match($pt_nontitle, $id, $index_raw, PREG_OFFSET_CAPTURE, 0);
        $index=($index_raw[1][0]);
        // $patternforchange='/(?<=\btitle=")[^"]*/';
        $patternforchange='/(?<=\])(.*)(?=\[)/s';
    }
    $index=$index-1;
    $patternforwhole='/(?s)\[et_pb_tabs [^][]*module_id="'.$main_id.'"[^][]*].*?\[\/et_pb_tabs]/';
    preg_match_all($patternforwhole,$content,$matches);
    $aftercontent=$matches[0][0];
    $patternforinneritems = '/(\[et_pb_tab .*?et_pb_tab])/s';
    
    preg_match_all($patternforinneritems, $aftercontent, $chota, PREG_SET_ORDER, 0);
    $replaced=preg_replace($patternforchange,$content_to,$chota[$index][0]);
    $chota[$index][0]=$replaced;
    foreach($chota as $key=>$row)
    {
        $chota[$key][1]="";
    }

    $tmpArr = array();
    foreach ($chota as $sub) {
    $tmpArr[] = implode('', $sub);
    }
    $result = implode('', $tmpArr);
    $ptcc='/(?<=\])(.*?)(?=\[\/et_pb_tabs\])/s';
    $semi_final=preg_replace($ptcc,$result,$aftercontent,1);
    $final=preg_replace($patternforwhole,$semi_final,$content);
    return $final;
    
}

?>