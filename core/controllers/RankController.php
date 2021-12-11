<?php 

/**
 * this is a demo controller
*/
namespace Core\Controllers;

require_once(MODEL_DIR.'/Rank.php');
use Core\Models\Rank;
require_once(TRAIT_DIR.'/CommonTrait.php');
use Core\Traits\CommonTrait;

class RankController
{
	use CommonTrait;
	private $rank;

	public function __construct()
	{
		//echo "called rank controller construct method<br/>";
		$this->rank = new Rank();
	}

	public function list()
	{
		$data = $this->rank->read();
		if($data == false) {
			$data = [];
			$_SESSION['response_message'] = ['Failed to read', 'danger'];
			$this->log(['response_message'=>$_SESSION['response_message'][0]]);
		}
		require_once($this->view('rank.index'));
	}

	public function create()
	{
		if (is_csrf_valid())
		{
			$response = $this->rank->create($_POST);
			if($response == false) {
				$_SESSION['response_message'] = ['Failed to create', 'danger'];
			} else {
				$_SESSION['response_message'] = ['Created successfully', 'success'];
			}
		}
		else
		{
			$_SESSION['response_message'] = ['Invalid token', 'danger'];
		}
		$this->log(['response_message'=>$_SESSION['response_message'][0], 'request_data'=>$_POST]);
		header('Location: '.ROUTE['/']);
		exit;
	}

	public function update()
	{
		if (is_csrf_valid())
		{
			$response = $this->rank->update($_POST);
			if($response == false) {
				$_SESSION['response_message'] = ['Failed to update', 'danger'];
			} else {
				$_SESSION['response_message'] = ['Updated successfully', 'success'];
			}
		}
		else
		{
			$_SESSION['response_message'] = ['Invalid token', 'danger'];
		}
		$this->log(['response_message'=>$_SESSION['response_message'][0], 'request_data'=>$_POST]);
		header('Location: '.ROUTE['/']);
		exit;
	}

	public function delete($id)
	{
		$response = $this->rank->delete($id);		
		if($response == false) {
			$_SESSION['response_message'] = ['Failed to delete', 'danger'];
		} else {
			$_SESSION['response_message'] = ['Deleted successfully', 'success'];
		}
		$this->log(['response_message'=>$_SESSION['response_message'][0], 'request_data'=>['id'=>$id]]);
		header('Location: '.ROUTE['/']);
		exit;
	}
}
