<?php
    require_once __DIR__.'/db.php';
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    class Test{
        function Users($requestMethod,$payload){
            switch ($requestMethod){
                case 'GET':
                    $db = new Connect;
                    $users = array();
                    $data = $db->prepare('SELECT * FROM tesy_prod ORDER BY id');
                    $data->execute();
                    while($outData = $data->fetch(PDO::FETCH_ASSOC)){
                        $users[$outData['id']] = array(
                        'id' => $outData['id'],
                            'name' => $outData['name'],
                            'class' => $outData['class'] 
                        );
                    }
                    return json_encode($users);
                case 'POST':
                    $db = new Connect;
                    try{
                        $data = $db->prepare('INSERT INTO tesy_prod(name,class) VALUES("jesse","ss3")');
                        $data->execute();
                        return json_encode(array('status'=>'success'));
                    }  
                    catch (PDOException $exception){
                        return json_encode(array('status'=>'failed','msg'=>"$exception")); 
                    }                  
                case 'PUT':
                    $db = new Connect;
                    try {
                        $data = $db->prepare(sprintf('UPDATE tesy_prod set name = "%s",class = "%s" where id = "%s"',$payload["name"],$payload["class"],$payload["id"]));
                        $data->execute();
                        return json_encode(array('status'=>'success'));   
                    }catch (PDOException $exception){
                        return json_encode(array('status'=>'failed','msg'=>"$exception")); 
                    }                
                case 'DELETE':
                    $db = new Connect;
                    try {
                        $data = $db->prepare(sprintf('DELETE from tesy_prod where id = "%s"',$payload["id"]));
                        $data->execute();
                        return json_encode(array('status'=>'success'));   
                    }catch (PDOException $exception){
                        return json_encode(array('status'=>'failed','msg'=>"$exception")); 
                    }                
                default:
                    header("HTTP/1.1 404 Not Found");
                    $obj = (object) array('status' => 'error','status_code' => 400, 'msg' => 'Method not allowed');
                    return json_encode($obj);
                    exit();
            }
        }
    }

?>