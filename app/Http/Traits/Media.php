<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\fileExists;

trait Media
{

    public function uploadMedia($image, $path)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images//' . $path), $imageName);
        return $imageName;
    }

    public function uploadManyMedia($image, $path, $count)
    {
        $imageName = time() . $count . '.' . $image->extension();
        $image->move(public_path('images//' . $path), $imageName);

        return $imageName;
    }

    public function deleteMedia($oldImageProduct, $path)
    {
        $oldImage = public_path("images//$path//" . $oldImageProduct);
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
    }

    public function storeLog($id, $ms)
    {
        $msg = $ms .  $id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return true;
    }
}
