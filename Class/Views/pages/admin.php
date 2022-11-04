<div class="container">
    <h2>Visualizando Novos chamados:</h2>
    <?php foreach($arr['chamados_novos'] as $key => $value){ 
        $listaInteracao = \Controllers\AdminController::listaInteracao($value['token']);
        
        
        
    ?>
    
    <br>
    <br>
    <br>
    <div class="mensagens-wrap">
        <div class="w100" style="text-align:right;"><a class="deletar" href="<?php echo INCLUDE_PATH; ?>admin?deletar=<?php echo $value['token']; ?>">Deletar</a></div>
        <div class="w100"><h2>Email:<?php echo $value['email']; ?></h2></div>
        <br>
        <br>
        <br>
        <div class="w100 "><h2>Pergunta: <h4><?php echo $value['pergunta']; ?></h4></h2></div>
        <br>
        <br>
        <br><br><br>
    <?php foreach($listaInteracao as $key => $valueLista){ ?>
        <?php if($valueLista['admin'] == -1){ ?>
            <div class="w100 flex"><i class="fa-solid fa-user"></i><p class="admin-msg"><b class="admin">Usuário:</b><?php echo $valueLista['mensagem']; ?></p></div>';
        <?php }else if($valueLista['admin'] == 1){ ?>
            <div class="w100 flex right"><p class="user-msg"><b class="user">Suporte:</b><?php echo $valueLista['mensagem']; ?></p><div class="img-suporte"></div></div>';
            <?php } ?>
    <?php } ?>
    
    <br><br>
    <br>
        <form action="" method="POST">
            <textarea name="resposta_chamado" id="" cols="30" rows="10" placeholder="Sua mensagem..."></textarea>
            <input type="hidden" name="token" value="<?php echo $value['token']; ?>">
            <input type="hidden" name="email" value="<?php echo $value['email']; ?>">
            <input type="hidden" name="mensagem" value="<?php echo $value['pergunta']; ?>">
            <input type="submit" name="responder_chamado" value="Responder"/>
        </form>
    </div><!--mensagens-wrap-->
    <?php } ?>
</div><!--container-->