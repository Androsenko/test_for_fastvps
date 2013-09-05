<?php
class Controller_Main extends Controller
	{
    function __construct()
		{
        $this->model = new Model_Main();
        $this->view = new View();
		}
    
    function action_index()
		{
        $data = $this->model->getInfoFromDB();		
        $this->view->generate('main_view.php', 'template_view.php', $data);
		}
		
	function action_update()
		{
        $data = $this->model->getInfoFromRemoteUrl(SITE1);		
        $this->view->generate('main_view.php', 'template_ajax.php', $data);
		}
		
	function action_single_update()
		{
        $data = $this->model->getInfoFromRemoteUrl_single(SITE1,$_GET['vid']);		
        $this->view->generate('main_view.php', 'template_ajax.php', $data);
		}
		
	function action_add()
		{
        $data = $this->model->setVisible($_GET['vname']);		
        $this->view->generate('main_view.php', 'template_ajax.php', $data);
		}
	
	function action_del()
		{
        $data = $this->model->delVisible($_GET['vname']);		
        $this->view->generate('main_view.php', 'template_ajax.php', $data);
		}
	}
?>