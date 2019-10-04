<?php



class Controller
{
    private $twig;
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('views');
        $this->twig = new Twig_Environment($loader);
        $filter = new Twig_Filter('lang', 'Lang::get');
        $this->twig->addFilter($filter);
    }

    protected function view($viewname, $data = [])
    {
        $ext = !empty(extension) ? extension : '.html';
        if (!file_exists(__root__.'/' . '/views/' . $viewname . $ext)) {
            echo 'Not found ' . $viewname;
            exit;
        }

        $data['__base__'] = __base__;
        $data['__env__'] = env;

        echo $this->twig->render($viewname . $ext, $data);
    }
}
