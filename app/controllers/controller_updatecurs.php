<?php
class Controller_Updatecurs extends Controller
	{
    function __construct()
		{
        $this->model = new Model_Updatecurs();
        $this->view = new View();
		}
    
    function action_index()
		{
        $data = $this->model->get_curs();		
        $this->view->generate('updatecurs_view.php', 'template_view.php', $data);
		}
	}
?>