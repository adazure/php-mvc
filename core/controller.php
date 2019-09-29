<?php
class Controller
{
    private $twig;
    public function __construct()
    {
            $loader = new Twig_Loader_Filesystem('views');
            $this->twig = new Twig_Environment($loader);
    }

    protected function view($viewname,$data = []){
        $ext = !empty(extension) ? extension : '.html';
        if(!file_exists (__root__.'/views/'.$viewname.$ext)){
            echo 'Not found '.$viewname;
            exit;
        }
        echo $this->twig->render($viewname.$ext,$data);
    }
}
