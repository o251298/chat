<?php


namespace App\Services\Other;


use Illuminate\Support\Facades\Auth;

class Business
{
    public $selectUser;
    public $path = '../storage/app/storage/';
    public  $fileName = '10239.txt';

    /*
     *
     * $arr = ["1_OlegKhrokalo" => [1,2,3,4,7,8,], "2_OlegPevcov" => [1,2,3,4,7,8,]];
     *
     */

    public function __construct()
    {
        $this->checkFileExist();
    }

    public function createFile()
    {
        $file = fopen($this->path . $this->fileName, 'a+');
        fclose($file);
    }

    public function checkFileExist()
    {
        if (!file_exists($this->path . $this->fileName))
        {
            $this->createFile();
            return true;
        }
    }

    public function track()
    {
        $currentUser = Auth::user();
    }
    public function note()
    {
//        $file = fopen($this->path . $this->fileName, 'a');
        $key = 'Oleg_Khrokalo';
        $serialize = [$key => [2,2,3]];
        $serialize = json_encode($serialize);
//        fwrite($file, $key . '#' . $serialize  . '/' . PHP_EOL);
//        fclose($file);
        $file = file($this->path . $this->fileName);
        $count = count($file);
        $file[$count] = $serialize . PHP_EOL;
        file_put_contents($this->path . $this->fileName, $file, FILE_APPEND);
        $this->validate();
    }

    public function validate()
    {
        $file = file($this->path . $this->fileName);
        $arr = array_unique($file);
        $file = $arr;
        file_put_contents($this->path . $this->fileName, $file);
    }

    public function readNote()
    {
        $file = file($this->path . $this->fileName);
        foreach ($file as $item)
        {
            $json = (array) json_decode(trim($item));
            $key = array_keys($json);
            $arr[$key[0]] = 1;
            dump($key);
        }

        dd($arr);
    }

//        $file = fopen($this->path . $this->fileName, 'r');
//        $f = fread($file, filesize($this->path . $this->fileName));
//        $arr = explode('/', $f);
//        $ar2 = [];
//        dump($f);
//        foreach ($arr as $key => $item)
//        {
//            $str = explode('#', trim($item));
//            if (isset($str[1])){
//                $ar2[$str[0]] = trim($str[1]);
//            }
//        }
//        dd($ar2);
}
