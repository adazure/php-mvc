<?php
class HomeController extends Controller
{
    public function index()
    {
        self::view('home');
    }

    public function product(){
        self::view('product');
    }

}
