<?php 

class DataHandlingController{


    static $errs=[];

    //that method takes tow strings 1-the input and return the data or null & 2-the error that you wish to show to the user
    static function handleData($input,$err){
        if(isset($_POST["$input"]))
        {
            if($_POST["$input"]!=null)
            {
                $data=$_POST["$input"];
                return $data;
            }
            else{
                //if there an error it will push it in to the 
                array_push(self::$errs,"$err");
               
            }

        }
        else{
             //if there an error it will push it in to the
            array_push(self::$errs,"$err");
        }

        
    }
}