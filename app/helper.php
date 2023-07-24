<?php


use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if(!function_exists('dosyasil'))
{
    function dosyasil($string)
    {
        if(file_exists($string))
        {
            if(!empty($string)){
                unlink($string);
            }
        }
    }
}


if(!function_exists('resimyukle'))
{
    function resimyukle($image,$name,$yol)
    {
        $uzanti = $image->getClientOriginalExtension();
        $dosyadi = time().'-'.Str::slug($name);

        $yukleKlasor = $yol;

        if($uzanti == 'pdf' || $uzanti == 'svg' || $uzanti == 'webp') {
            $image->move(public_path($yukleKlasor),$dosyadi.'.'.$uzanti);

            $resimUrl = $yukleKlasor.$dosyadi.'.'.$uzanti;
        }else {
            $image = Image::make($image);
            $image->encode('webp',75)->save($yukleKlasor.$dosyadi.'.webp');

            $resimUrl = $yukleKlasor.$dosyadi.'.webp';
        }
        return $resimUrl;
    }
}