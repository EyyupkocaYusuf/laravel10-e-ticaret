<?php


use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if(!function_exists('GenerateOtp')){
    function GenerateOtp($n) {
        $generator = '1357902468';
        $result = '';
        for ($i=1; $i <= $n; $i++) {
            $result .= substr($generator,(rand()%(strlen($generator))),1);
        }
        return $result;
    }
}

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


if(!function_exists('sifrele')) {
    function sifrele($string) {
        return encrypt($string);
    }
}

if(!function_exists('sifreCoz')) {
    function sifreCoz($string) {
        return decrypt($string);
    }
}
