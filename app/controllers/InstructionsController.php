<?php

class InstructionsController extends Controller {

    private $viewFolder = "instructions";

    public function setViewFolder($vf) { 
        $this->viewFolder = $vf; 
    }
    public function getViewFolder() { 
        return $this->viewFolder; 
    }

    public function list()
    {
        $classvar = new Instructions($this->db);
        $this->f3->set('sqldata',$classvar->list($this->f3->get('SESSION.company')));
        $this->f3->set('section','instructions');
        //$this->f3->set('breadcrumbs',$classvar->breadcrumbs($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company')));
        $this->f3->set('page_head','List');
        $this->f3->set('subnav','true');
        $this->f3->set('back','no');
        $this->f3->set('backto','instructions');
        $this->f3->set('create','no');
        $this->f3->set('review','no');
        $this->f3->set('columns','[1,2,3]');
        $this->f3->set('relation',$this->f3->get('PARAMS.id'));
        $this->f3->set('view',$this->getViewFolder().'/stations.htm');
    }

    public function index()
    {
        $classvar = new Instructions($this->db);
        $this->f3->set('sqldata',$classvar->all($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company')));
        $this->f3->set('section','instructions');
        $this->f3->set('breadcrumbs',$classvar->breadcrumbs($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company')));
        $this->f3->set('page_head','List');
        $this->f3->set('subnav','true');
        $this->f3->set('back','yes');
        $this->f3->set('backto','instructions');
        $this->f3->set('preview','yes');
        $this->f3->set('columns','[1,2,3,4]');
        $this->f3->set('relation',$this->f3->get('PARAMS.id'));
        $this->f3->set('view',$this->getViewFolder().'/list.htm');
    }

    public function view()
    {
        $classvar = new Instructions($this->db);
        $this->f3->set('sqldata',$classvar->list($this->f3->get('SESSION.company')));
        $this->f3->set('section','instructions');
        //$this->f3->set('breadcrumbs',$classvar->breadcrumbs($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company')));
        $this->f3->set('page_head','List');
        $this->f3->set('subnav','true');
        $this->f3->set('back','no');
        $this->f3->set('backto','instructions/view');
        $this->f3->set('create','no');
        $this->f3->set('columns','[1,2,3]');
        $this->f3->set('relation',$this->f3->get('PARAMS.id'));
        $this->f3->set('view',$this->getViewFolder().'/view.htm');
    }

    public function fdisplay()
    {
        $classvar = new Instructions($this->db);
        $instArray = $classvar->all($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company'));
        $instImage = $classvar->images($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company'));
        $this->f3->set('instructions',$instArray);
        $this->f3->set('section','instructions');
        $this->f3->set('subnav','true');
        $this->f3->set('preview','yes');
        $this->f3->set('back','yes');
        $this->f3->set('create','no');
        $this->f3->set('backto','instructions/view');
        $this->f3->set('columns','[0,1,2,3]');
        $this->f3->set('images',$instImage);
        $this->f3->set('breadcrumbs',$classvar->breadcrumbs($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company')));
        $this->f3->set('page_head','List');
        $this->f3->set('relation',$this->f3->get('PARAMS.id'));
        $this->f3->set('view',$this->getViewFolder().'/full.htm');
    }

    public function gdisplay()
    {
        $classvar = new Instructions($this->db);
        $instArray = $classvar->grid($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company'));
        //$instImage = $classvar->images($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company'));
        $this->f3->set('instructions',$instArray);
        $this->f3->set('section','instructions');
        $this->f3->set('subnav','true');
        $this->f3->set('back','yes');
        $this->f3->set('backto','instructions/view');
        $this->f3->set('preview','yes');
        $this->f3->set('columns','[0,1,2,3]');
        $this->f3->set('create','no');
        //$this->f3->set('images',$instImage);
        $this->f3->set('breadcrumbs',$classvar->breadcrumbs($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.company')));
        $this->f3->set('page_head','List');
        $this->f3->set('relation',$this->f3->get('PARAMS.id'));
        $this->f3->set('view',$this->getViewFolder().'/grid.htm');
    }

    public function apiproducts()
    {
        $classvar = new Instructions($this->db);
        $company =  $this->f3->get('SESSION.company');
        $this->f3->set('ups',$classvar->apiproducts($company) );
	    exit;    	// API Call to get data for popup
    }

    public function chart()
    {
	    $this->f3->set('page_head','Chart');
        $this->f3->set('json','sampleData');
	    $this->f3->set('view',$this->getViewFolder().'/chart.htm');
    }

    public function create()
    {
        if($this->f3->exists('POST.create'))
        {
            $classvar = new Instructions($this->db);
            $classvar->add();
            $this->f3->reroute('/'.$this->getViewFolder()."/".$this->f3->get('POST.relation'));
        }
        else
        {
            $classvar = new Instructions($this->db);
            $this->f3->set('page_head','New');
            $this->f3->set('mode','create');
            $this->f3->set('breadcrumbs',$classvar->breadcrumbs($this->f3->get('PARAMS.id'),$this->f3->get('SESSION.user')));
            $this->f3->set('nextsequence',$classvar->lastsequence($this->f3->get('PARAMS.id')));
            $this->f3->set('relation',$this->f3->get('PARAMS.id'));
            $this->f3->set('view','/'.$this->getViewFolder().'/hybrid.htm');
        }
    }

    public function update()
    {
        $classvar = new Instructions($this->db);

        if($this->f3->exists('POST.update'))
        {
            $classvar->edit($this->f3->get('POST.id'));
            $this->f3->reroute('/'.$this->getViewFolder()."/".$this->f3->get('POST.relation'));
        }
        else
        {
            $classvar->getById($this->f3->get('PARAMS.id'));
            $this->f3->set('page_head','Update');
            $this->f3->set('mode','update');
            $this->f3->set('relation',$classvar->relation($this->f3->get('PARAMS.id')));
            $this->f3->set('view',$this->getViewFolder().'/hybrid.htm');
        }
    }

    public function delete()
    {
        if($this->f3->exists('PARAMS.id'))
        {
            $classvar = new Instructions($this->db);
            $relation = $classvar->relation($this->f3->get('PARAMS.id'));
            $classvar->delete($this->f3->get('PARAMS.id'));
        }

        $this->f3->reroute('/'.$this->getViewFolder()."/".$relation);
    }

} // main class

?>
