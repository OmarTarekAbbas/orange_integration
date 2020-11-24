<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $form_methods = [
        "get" => "GET",
        "post" => "POST",
        "patch" => "PATCH",
        "delete" => "DELETE",
        "put" => "PUT",
    ];

    public function get_methods($filename)
    {
        $path = $this->file_build_path("app", "Http", "Controllers");
        $txt_file = file_get_contents($path . '/' . $filename);
        $matches = array();
        preg_match_all("/ function (.*)\(\D*\w*\)/U", $txt_file, $matches);
        $result = $matches[1];
        return $result;
    }

    public function get_controllers()
    {
        $controllers = array();
        $i = 0;
        $path = $this->file_build_path("app", "Http", "Controllers");
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != "Auth" && $file != "Controller.php" && $file != "ScaffoldInterface") {
                    $parsed_methods[explode('.php', $file)[0]] =
                    $this->get_methods($file);
                }
            }
            closedir($handle);
            return $parsed_methods;
        }
    }

    public function file_build_path(...$segments)
    {
        return join(DIRECTORY_SEPARATOR, $segments);
    }

    public function delete_image_if_exists($image_path)
    {
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

}
