<?php 
    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    include('config.php');

    $c1 = new Config();

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $res = $c1->insertUser($name,$email,$phone);

        if($res)
        {
            $arr['msg'] = 'Data inserted !';
        }
        else
        {
            $arr['msg'] = 'Data not inserted !';
        }
    }
    elseif($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $res = $c1->fetchUser();
        $user = [];
        
        if($res)
        {
            while ($data = mysqli_fetch_assoc($res)) {
                array_push($user, $data);
                $arr['data'] = $user;
            }
        }
        else
        {
            $arr['msg'] = 'Data not found !';
        }
    }
    else
    {
        $arr['msg'] = 'Only POST and GET type allowed !';
    }
    echo json_encode($arr);
?>