<?php
    session_start();
    require __DIR__.'/Vendor/autoload.php';

    use App\Entity\Post;

    $posts = Post::getPosts();

    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
         header('location: index.php?status=error');
    }

    include __DIR__.'/Includes/header.php';

    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        if(isset($posts[$id])){
            if(isset($_SESSION['cart'][$id])){
                $_SESSION['cart'][$id]['quantidade']++;
            }else{
                $_SESSION['cart'][$id] = array('quantidade' => 1, 'nome' => $posts[$id]->titulo);
            }
            echo '<script> alert("O item foi add");</script>';
        }else{
            die('item não existe');
        }
    }
?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                </tr>
            </thead>
            <tbody>
<?php
    #imprimindo carrinho
    foreach ($_SESSION['cart'] as $key => $value){
            echo '
                <tr>
                    <td>'.$value['nome'].'</td>
                    <td>'.$value['quantidade'].'</td>
                </tr>';
                }
?>
    </tbody>
    </table
<?php
    include __DIR__.'/Includes/footer.php';
?>