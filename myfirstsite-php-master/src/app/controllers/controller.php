<?php 
namespace Controllers;

class Controller
{    
    function respond($data)
    {
        echo json_encode($data);
    }

    function respondWithError($httpcode, $message)
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpcode, $data);
    }

    public function respondWithCode($httpcode, $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpcode);
        echo json_encode($data);
    }

    public function respondFileWithCode($httpcode, $pictureName)
    {
        $file_extension = strtolower(substr(strrchr($pictureName,"."),1));
        
        switch( $file_extension ) {
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpeg"; break;
            case "svg": $ctype="image/svg+xml"; break;
            default:
        }
        
        header('Content-Type: ' . $ctype);
        http_response_code($httpcode);
        $this->extractSource($pictureName);
    }

    public function extractSource($filename)
    {
        $path =  '../public/uploads' . '/' . $filename;
        $data = base64_encode(file_get_contents($path));
        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
    
        return $src;
    }

    function createObjectFromPostedJson($className)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $object = new $className();
        foreach ($data as $key => $value) {
            if(is_object($value)) {
                continue;
            }
            $object->{$key} = $value;
        }
        return $object;
    }
}
?>