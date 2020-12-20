<?php

namespace Hcode;

use Rain\Tpl;   

class Page {
    //atributos
    private $tpl;
    private $options = [];
    private $default = [
        "header"=>true,
        "footer"=>true,
        "data"=>array()
    ];

    //metodos
    public function setData($data = array())
    {
        foreach($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function __construct($opts = array(), $tpl_dir = "/views/")
    {
        $this->options = array_merge($this->default, $opts);

        // config
        $config = array(
        "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
        "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
        "debug"         => false, // set to false to improve the speed
        );

        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        if($this->options["header"] === true) { 
            $this->tpl->draw("header");
        }    
    }

    public function setTpl($name, $data = array(), $returnHTML = false)
    {

        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct()
    {
        if($this->options["footer"] === true) {
            $this->tpl->draw("footer");
        }
    }


}







?>