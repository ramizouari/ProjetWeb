<?php


namespace App\fonctions_perso;


use Twig\TwigFunction;

class extraction_fun extends \Twig\Extension\AbstractExtension
{

    public function getFunctions()
    {
        return [ new TwigFunction("extract",[$this,"Data_Extract"])] ;
    }


    function Data_Extract($id){

        if(!isset($id)){

            $id="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR3gLrrUG0QXFuHfoFyag3776D_i1zLIavjbPBGUExllzsLrTRA&usqp=CAU";
        }
        return $id;

    }

    function user_Extract($id){




        if(!isset($id)){

            $rep=$this->

            $id="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR3gLrrUG0QXFuHfoFyag3776D_i1zLIavjbPBGUExllzsLrTRA&usqp=CAU";
        }
        return $id;

    }


}