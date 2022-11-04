<div class="container">
    <h2>Visualizando chamado: <?php echo $_GET['token']; ?></h2>
    <br>
    <br>
    <br>
    <h2>Pergunta: <h4><?php echo $arr['pergunta']; ?></h4></h2>
    <br>
    <br>
    <br>
    <h2>Mensagens:</h2>
    <br>
    <div class="mensagens-wrap">
    <?php foreach($arr['respostas_interacao'] as $key => $value){     
        if($value['admin'] == 1){
            echo '<div class="w100 flex"><div class="img-suporte"></div><p class="admin-msg"><b class="admin">Admin:</b>'.$value['mensagem'].'</p></div>';
        }else if($value['admin'] == -1){
            echo '<div class="w100 flex right"><p class="user-msg"><b class="user">Você:</b>'.$value['mensagem'].'</p><i class="fa-solid fa-user"></i></div>';
        }
    }
    ?>
    </div><!--mensagens-wrap-->
    <br><br>
    <br>
    <?php if($arr['ultima_resposta'] == 'true'){ ?>
        <form action="" method="POST">
            <textarea name="resposta" id="" cols="30" rows="10" placeholder="Sua mensagem..."></textarea>
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <input type="submit" name="responder_chamado" id=""/>
        </form>
    <?php }else{ ?>
        <p class="w100">Aguarde A resposta do Suporte!</p>
    <?php } ?>

</div><!--container-->
