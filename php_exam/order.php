<?php 
    header("Access-Control-Allow-Method: POST,DELETE");
    header("Content-Type: application/json");

    include('config.php');

    $c1 = new Config();

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $order_date = $_POST['order_date'];
        $status = $_POST['status'];

        $res = $c1->insertOrder($order_date,$status);

        if($res)
        {
            $arr['msg'] = 'Data inserted order !';
        }
        else
        {
            $arr['msg'] = 'Data not inserted !';
        }
    }
    elseif($_SERVER['REQUEST_METHOD'] == "DELETE")
    {
        $data = file_get_contents("php://input");
        parse_str($data,$result);

        $id = $result['id'];

        $res = $c1->deleteOrder($id);

        if($res)
        {
            $arr['msg'] = 'Data deleted !';
        }
        else
        {
            $arr['msg'] = 'Data not deleted !';
        }
    }
    else
    {
        $arr['msg'] = 'Only POST and DELETE type allowed !';
    }
    echo json_encode($arr);
?>