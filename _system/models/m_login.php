<?php
//---------------------------------------------------------------------------------------------
// ������ �����������
//---------------------------------------------------------------------------------------------

Class M_Login {
    
    //����� ����� ��� �����������
    public function _auth_m ($login, $pass){
        $login  = DB::quote($login);
        $res    = DB::query("SELECT * FROM ".TABLE_USERS." WHERE login = ".$login." AND pass = '".Lib::_encoding_pass($pass)."' AND access = 'yes'");
        return DB::fetchAssoc($res);
    } 
    
    public function _find_blocked_ip($ip){
    	
    	$query = "DELETE QUICK FROM ".TABLE_BLOCKED_IP." WHERE date_time < DATE_SUB(NOW(),INTERVAL 1 MONTH)";
		$res = DB::exec($query);
		
		
    	$query = "SELECT * FROM ".TABLE_BLOCKED_IP." WHERE ip = '".$ip."'";
		$res = DB::query($query);
		return DB::numRows($res);
	}
	
	public function _add_blocked_ip($ip){
    	$query = "INSERT INTO ".TABLE_BLOCKED_IP." SET ip = '".$ip."', date_time=NOW() ";
		$res = DB::exec($query);
		return true;
	}
	
	public function _clear_blocked_ip($ip){
    	$query = "DELETE QUICK FROM ".TABLE_BLOCKED_IP." WHERE ip = '".$ip."'";
		$res = DB::exec($query);
		return true;
	}
	
	
    
    
}
?>