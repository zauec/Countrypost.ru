<?
require_once(MODELS_PATH.'Base/BaseModel.php');
/**
 * @author omni
 *
 */
class UserModel extends BaseModel implements IModel {

	protected 	$properties			= null;				// array of properties
	protected	$table				= 'users';			// table name
	protected	$PK					= 'user_id';		// primary key name
	
	
	/**
	 * конструктор
	 *
	 */
	function __construct()
    {
    	$this->properties					= new stdClass();
    	$this->properties->user_id			='';
    	$this->properties->user_login		='';
    	$this->properties->user_password	='';
    	$this->properties->user_group		='client';
    	$this->properties->user_email		='';
    	$this->properties->user_coints		='';
    	$this->properties->user_deleted		=0;
    	$this->properties->positive_reviews	=0;
    	$this->properties->neutral_reviews	=0;
    	$this->properties->negative_reviews	=0;

        parent::__construct();
    }
    

    /**
     * @see IModel
     * Инкапсуляция
     *
     * @return string
     */
	public function getPK()
	{
		return $this->PK;
	}
	
	
	
    /**
     * @see IModel
     * Инкапсуляция
     *
     * @return string
     */	
	public function getTable()
	{
		return $this->table;
	}     
    
    
    /**
     * Get user list
     *
     */
	public function getList()
	{
		$sql = $this->select();
		return ($sql)?($sql):(false);
	}
	
	
	/**
	 * Get property list
	 *
	 * @return array
	 */
	public function getPropertyList()
	{
		return array_keys((array) $this->properties);
	}
	
	/**
	 * Get object by id
	 *
	 * @param int $id
	 * @return object
	 */
	public function getById($id){
		$r = $this->select(array(
			$this->getPK()	=> (int) $id,
		));					
		
		return ((count($r==1) &&  $r) ? array_shift($r) : false);
	}
	
	
	/**
	 * Get user data
	 *
	 * @param (string) $login
	 * @param (string) $password
	 * @return object
	 */
	public function getUser($login,$password){
		
		$r = $this->select(array(
			'user_login'		=> $login,
			'user_password'	=> $password
		));	
		
		return ((count($r==1) &&  $r) ? array_shift($r) : false);		
	}
	public function getUserForLogin($login, $password, $vk=false){
		
		if (!$vk) {
			$r = $this->select(array(
			'user_login' => $login,
			'user_password'	=> $password,
			'user_deleted' => '0'
			));	
		} else { // if vkontakte OR facebook user
			$r = $this->select(array(
			'user_login'		=> $login,
			'user_deleted' => '0'
			));	
			
		}
		
		
		return ((count($r==1) &&  $r) ? array_shift($r) : false);		
	}
	
	public function getUserByEmail($email){
		
		$r = $this->select(array(
									'user_email'	=> $email,
		));					
		
		return ((count($r==1) &&  $r) ? array_shift($r) : false);		
	}
	
	public function getUserByLogin($login){
		
		$r = $this->select(array(
									'user_login'	=> $login,
		));					
		
		return ((count($r==1) &&  $r) ? array_shift($r) : false);		
	}

	
	/**
	 * Добавление пользователя
	 * Коды ошибок в отрицательной зоне (-1:USER_ALREADY_EXISTS; -2:EMAIL_ALREADY_EXISTS)
	 * Выкидывает исключения на некорректные данные
	 * 
	 * @param (object) 	- $user_obj
	 * @return (mixed)	- объекст user или false в случае ошибки записи в базу
	 */
	public function addUser($user_obj){
		
		$props = $this->getPropertyList();
		
		//if ($this->select(array('user_login' => $user_obj->user_login))){
		//	throw new Exception(USER_ALREADY_EXISTS, -1);
		//}
		
		if ($this->select(array('user_email' => $user_obj->user_email))){
			throw new Exception(EMAIL_ALREADY_EXISTS, -2);
		}
		
		foreach ($props as $prop){
			if (isset($user_obj->$prop)){
				$this->_set($prop, $user_obj->$prop);
			}
		}
		
		$new_id = $this->insert();
		
		if ($new_id){
			return $this->getInfo(array($new_id));
		}
		
		return false;
	}
	
	public function updateUser($user_obj) {
		$props = $this->getPropertyList();
		
		if ($e_user = $this->select(array('user_email' => $user_obj->user_email))){			
			if ($e_user[0]->user_id != $user_obj->user_id)
				throw new Exception(EMAIL_ALREADY_EXISTS, -2);
		}
		
		foreach ($props as $prop){
			if (isset($user_obj->$prop)){
				$this->_set($prop, $user_obj->$prop);
			}
		}
		
		if ($this->save(true))
			return $this->getInfo(array($user_obj->user_id));
		else
			return false;
	}
	
	
	
	public function chargeCoints($user_id, $sum){
		
		if (!(float)$sum) {
			return false;
		}
		
		$user = $this->getById((int) $user_id);
		$user->user_coints += (float) $sum;
		
		// чтобы записывался 0, указываем его явно
		if (!$user->user_coints)
		{
			$user->user_coints = 0;
		}
		
		$this->_load($user);
		
		if ($this->save(true)){
			return true;			
		}
		return false;
	}
	
	public function deleteUser($u) {
		$this->_set('user_id', $u->user_id);
		$this->_set('user_group', $u->user_group);
		$this->_set('user_deleted', 1);
		if (!$this->save()) {
			throw new Exception('Пользователь не может быть удален', -1);
		}
		return true;
	}

    public static function getTemporaryKey ($autocreate = TRUE)
    {
        $temp_id = Stack::last('temporary_user_id');

        if (!$temp_id AND $autocreate)
        {
            $int_session_value = preg_replace("[A-Za-z]", "1", session_id());
            $int_session_value = (int) $int_session_value;
            $left_bound = -(time()+$int_session_value);

            Stack::push('temporary_user_id', rand($left_bound,-1));

            $temp_id = Stack::last('temporary_user_id');
        }

        return $temp_id;
    }
}
?>