<?php namespace App\Wiki;

interface PageInterface
{
    public function getFilePath($arg1, $arg2, $arg3, $arg4, $arg5);
    public function getContentsOfFile($path);
    public function getTitleOfFile($path);
}