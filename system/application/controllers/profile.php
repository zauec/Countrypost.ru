<?php
require_once BASE_CONTROLLERS_PATH.'BaseController'.EXT;

class Profile extends BaseController {
	function __construct()
	{
		parent::__construct();	
		
		$this->paging_base_url = '/profile/index';	 
		View::$main_view	= '/main/index';
		Breadcrumb::setCrumb(array('/' => 'Главная'), 0);
		Breadcrumb::setCrumb(array('/dealers' => 'Посредники'), 1);
	}
	
	public function index() 
	{
		switch ($this->user->user_group)
		{
			case 'user' : 
			{
				Func::redirect(BASEURL);
				break;
			}
			case 'manager' : 
			{
				$this->editDealerProfile();
				break;
			}
			default : 
			{
				Func::redirect(BASEURL);
			}
		}		
	}
	
	public function router($login) 
	{
		try
		{
			$this->load->model('UserModel', 'Users');
			$user = $this->Users->getUserByLogin($login);

			if (empty($user))
			{
				Func::redirect(BASEURL);
			}
			
			
			$this->load->model('ManagerModel', 'Managers');
			$manager = $this->Managers->getById($user->user_id);
			
			if (empty($manager))
			{
				$this->load->model('ClientModel', 'Clients');
				$client = $this->Clients->getById($user->user_id);
			
				if (empty($client))
				{
					Func::redirect(BASEURL);
				}
				
				$this->showClientProfile($client);
			}
			
			$this->showDealerProfile($manager, $login);
		}
		catch (Exception $e) 
		{
			Func::redirect(BASEURL);
		}	
	}
	
	private function showDealerProfile($manager, $login)
	{
		$this->processStatistics($manager, array(), 'manager_user', $manager->manager_user, 'manager');
			
		Breadcrumb::setCrumb(array('/' . $login => $manager->statistics->fullname), 2);

		$this->dealerProfileGeneric($manager, $login, 'main/pages/dealer');
	}

	private function editDealerProfile()
	{
		try
		{
			// находим партнера
			$this->load->model('ManagerModel', 'Managers');
			$manager = $this->Managers->getById($this->user->user_id);
			
			$this->processStatistics($manager, array(), 'manager_user', $manager->manager_user, 'manager');
		
			Breadcrumb::setCrumb(array('/profile' => 'Мой профиль'), 1, TRUE);
			
			$this->dealerProfileGeneric($manager, $this->session->userdata('manager_login'), 'manager/pages/editProfile');
		}
		catch (Exception $e) 
		{
			//Func::redirect(BASEURL);
		}		
	}

	private function dealerProfileGeneric($manager, $login, $view_name)
	{
		try
		{
			// находим страны
			$this->load->model('CountryModel', 'Country');		
			
			// находим статусы
			$view['statuses'] = $this->Managers->getStatuses();
				
			if ( ! $view['statuses'])
			{
				throw new Exception('Статусы не найдены. Попробуйте еще раз.');
			}
			
			$this->load->model('CurrencyModel', 'Currencies');		
				
			$view['manager_user'] = $manager->manager_user;
			$view['manager'] = $manager;
			$view['manager']->currency_symbol = $this->Currencies->getCurrencyByCountry($view['manager']->manager_country)->currency_symbol;
			
			$this->load->model('CountryModel', 'Country');
			$Countries	= $this->Country->getList();
			$countries = array();
			$countries_en = array();
			
			foreach ($Countries as $Country)
			{
				$countries[$Country->country_id] = $Country->country_name;
				$countries_en[$Country->country_id] = $Country->country_name_en;
			}
			
			$view['countries'] = $countries;
			$view['countries_en'] = $countries_en;

			// блог
			$this->load->model('BlogModel', 'Blogs');
			$view['blogs']	= $this->Blogs->getBlogsByUserId($manager->manager_user);
			
			// доставка
			$view['deliveries']	= $this->Managers->getManagerDeliveries($manager->manager_user);			
			
			View::showChild($view_name, $view);
		}
		catch (Exception $e) 
		{
			//Func::redirect(BASEURL.$this->cname);
		}
	}
}