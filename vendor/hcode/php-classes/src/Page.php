<?php

namespace Hcode;

use Rain\Tpl;   

class Page {
    //atributos
    private $tpl;
    private $options = [];
    private $default = [
        "data"=>array()
    ];

    //metodos
    public function setData($data = array())
    {
        foreach($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function __construct($opts = array())
    {
        $this->options = array_merge($this->default, $opts);

        // config
        $config = array(
        "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
        "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
        "debug"         => false, // set to false to improve the speed
        );

        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        $this->tpl->draw("header");
    }

    public function setTpl($name, $data = array(), $returnHTML = false)
    {

        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct()
    {
        $this->tpl->draw("footer");
    }


}







?>