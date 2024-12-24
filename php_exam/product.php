<?php 
    header("Access-Control-Allow-Method: POST,PUT");
    header("Content-Type: application/json");

    include('config.php');

    $c1 = new Config();

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];

        $res = $c1->insertProduct($product_name,$price);

        if($res)
        {
            $arr['msg'] = 'Data inserted products!';
        }
        else
        {
            $arr['msg'] = 'Data not inserted !';
        }
    }
    elseif($_SERVER['REQUEST_METHOD'] == "PUT")
    {
        $data = file_get_contents("php://input");
        parse_str($data,$result);

        $id = $result['id'];
        $product_name = $result['product_name'];
        $price = $result['price'];

        $res = $c1->updateProduct($id,$product_name,$price);

        if($res)
        {
            $arr['msg'] = 'Data updated successfuly!';
        }
        else
        {
            $arr['msg'] = 'Data not updated !';
        }
    }
    else
    {
        $arr['msg'] = 'Only POST and PUT type allowed !';
    }
    echo json_encode($arr);
?>