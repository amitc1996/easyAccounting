<?php
function getUserPermissions()
{

        $CI = & get_instance();
        $userId = $CI->aauth->get_user_id();
        $permissions = [];
        //get all permissions of the group(s) to which the user belongs

        $query = $CI->db->select('aauth_perms.*')
                             ->join('aauth_perm_to_group','aauth_perm_to_group.group_id = aauth_user_to_group.group_id')
                             ->join('aauth_perms','aauth_perms.id = aauth_perm_to_group.perm_id')
                             ->where('aauth_user_to_group.user_id',$userId)
                             ->get('aauth_user_to_group');

        $userGrpPermissions = $query->result();


        //get all other permissions granted for the user
        $query2 = $CI->db->select('aauth_perms.*')
                        ->join('aauth_perms','aauth_perms.id = aauth_perm_to_user.perm_id')
                        ->where('aauth_perm_to_user.user_id',$userId)
                        ->get('aauth_perm_to_user');

        $userPermissions = $query2->result();

        if(count($userGrpPermissions)){
            foreach($userGrpPermissions as $obj){
                if(!in_array(trim($obj->controller).'_'.trim($obj->method),$permissions))
                {//check for duplicate value
                  array_push($permissions,trim($obj->controller).'_'.trim($obj->method));
                }
            }
        }

        if(count($userPermissions)){
            foreach($userPermissions as $obj){
                if(!in_array(trim($obj->controller).'_'.trim($obj->method),$permissions))
                {//check for duplicate value
                  array_push($permissions,trim($obj->controller).'_'.trim($obj->method));
                }
            }
        }

       return array_map('strtolower', $permissions);
}

function getCustSnippets()
{
        $CI = & get_instance();
        //get all permissions of the group(s) to which the user belongs
        $query = $CI->db->select('*')
                             ->where('is_deleted',0)
                             ->get('snippets');
        return $query->result();
}


function URL_exists($url){

   $headers= @get_headers($url);
   return stripos($headers[0],"200 OK")?true:false;
}

if ( ! function_exists('checkEditUnique')){

   function checkEditUnique($id,$fieldvalue,$table,$column_name,$id_column_name){

      $CI =& get_instance();
      $CI->db->select('*')
      ->where($column_name,$fieldvalue)
      ->where($id_column_name.'!=',$id);

      $query = $CI->db->get($table);

      if($query->num_rows() > 0) return false;
      return true;
   }


function moneyFormatIndia($amt){
    $num= round($amt);
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i < sizeof($expunit);  $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return '₹ '.$thecash.'/-'; // writes the final format where $currency is the currency symbol.
}

}
?>
