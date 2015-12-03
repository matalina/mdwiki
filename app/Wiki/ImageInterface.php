<?php namespace App\Wiki;

interface ImageInterface
{
    public function getImage($filename);
    public function getExtension($filename);
}