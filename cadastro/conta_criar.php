<?php
include '../conecta.php';

$cadastro_efetuado = false;

if (!empty($_POST)) {
    
    $email = $_POST['email'];
    $sqlCheckEmail = "SELECT COUNT(*) AS count FROM USUUsuario WHERE USUEmail = '$email'";
    $resCheckEmail = mysqli_query($conn, $sqlCheckEmail);
    $row = mysqli_fetch_assoc($resCheckEmail);
    
    if ($row['count'] > 0) {
        
        echo '<div class="gradient-custom text-center" style="color: white; border: 0; font-size: 25px; border-radius: 0;">Email já existe! Cadastro não efetuado.</div>';
    } else {
        
        $sqlUSUUsuario = "INSERT INTO USUUsuario(USUNome, USUSenha, USUEmail) VALUES ('".$_POST['nome']."', '".$_POST['senha']."', '".$email."')";
        $resUSUUsuario = mysqli_query($conn, $sqlUSUUsuario);

        if ($resUSUUsuario) {
            $cadastro_efetuado = true; 
        }
    }
}

if ($cadastro_efetuado) {
    echo '<div class="gradient-custom text-center" style="color: white; border: 0; font-size: 25px; border-radius: 0;">Cadastro efetuado com sucesso! Voce sera redirecionado em breve...</div>';
    echo '<script>
        setTimeout(function() {
            window.location.href = "../../index.php";
        }, 3000); // Redireciona apos 3 segundos (3000 milissegundos)
    </script>';
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-3 mt-md-4 pb-3"> 
                            <h2 class="fw-bold mb-2 text-uppercase">Cadastro</h2>
                            <p class="text-white-50 mb-3">Preencha seus dados para criar uma conta!</p>

                            <form method="post" action="./conta_criar.php">
                                <div class="form-outline form-white mb-3"> 
                                    <input type="text" name="nome" id="typeNameX" class="form-control form-control-lg require" required />
                                    <label class="form-label" for="typeNameX">Nome</label>
                                </div>

                                <div class="form-outline form-white mb-3"> 
                                    <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg require" required />
                                    <label class="form-label" for = "typeEmailX">Email</label>
                                </div>

                                <div class="form-outline form-white mb-2"> 
                                    <input type="password" name="senha" id="typePasswordX" class="form-control form-control-lg require" required />
                                    <label class="form-label" for="typePasswordX">Senha</label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="aceito_termos" id="aceitoTermos" class="form-check-input" required />
                                    <label class="form-check-label" for="aceitoTermos" data-toggle="modal" data-target="#modalTermos">
                                        Li e concordo com os Termos de Uso
                                    </label>
                                </div>

                                <button id="cadastrarBtn" class="btn btn-outline-light btn-lg px-5" type="submit">Cadastrar</button>
                            </form>
                            <p></p>
                            <div>
                                <a href="../../index.php" class="text-white-50 fw-bold">Voltar para a tela de login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalTermos" tabindex="-1" role="dialog" aria-labelledby="modalTermosLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTermosLabel">Termos de Uso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <p><strong>PolÃ­tica de Privacidade do Tasker:</strong></p>
            <p>A sua privacidade Ã© importante para nÃ³s. Ã‰ polÃ­tica do Tasker respeitar a sua privacidade em relaÃ§Ã£o a qualquer informaÃ§Ã£o sua que possamos coletar no site Tasker, e outros sites que possuÃ­mos e operamos.</p>
            <p>Solicitamos informaÃ§Ãµes pessoais apenas quando realmente precisamos delas para lhe fornecer um serviÃ§o. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. TambÃ©m informamos por que estamos coletando e como serÃ¡ usado.</p>
            <p>Apenas retemos as informaÃ§Ãµes coletadas pelo tempo necessÃ¡rio para fornecer o serviÃ§o solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitÃ¡veis â€‹â€‹para evitar perdas e roubos, bem como acesso, divulgaÃ§Ã£o, cÃ³pia, uso ou modificaÃ§Ã£o nÃ£o autorizados.</p>
            <p>NÃ£o compartilhamos informaÃ§Ãµes de identificaÃ§Ã£o pessoal publicamente ou com terceiros, exceto quando exigido por lei. O nosso site pode ter links para sites externos que nÃ£o sÃ£o operados por nÃ³s. Esteja ciente de que nÃ£o temos controle sobre o conteÃºdo e prÃ¡ticas desses sites e nÃ£o podemos aceitar responsabilidade por suas respectivas polÃ­ticas de privacidade.</p>
            <p>VocÃª Ã© livre para recusar a nossa solicitaÃ§Ã£o de informaÃ§Ãµes pessoais, entendendo que talvez nÃ£o possamos fornecer alguns dos serviÃ§os desejados. O uso continuado de nosso site serÃ¡ considerado como aceitaÃ§Ã£o de nossas prÃ¡ticas em torno de privacidade e informaÃ§Ãµes pessoais.</p>
            <p>Se vocÃª tiver alguma dÃºvida sobre como lidamos com dados do usuÃ¡rio e informaÃ§Ãµes pessoais, entre em contato conosco.</p>
            <p>O serviÃ§o Google AdSense que usamos para veicular publicidade usa um cookie DoubleClick para veicular anÃºncios mais relevantes em toda a Web e limitar o nÃºmero de vezes que um determinado anÃºncio Ã© exibido para vocÃª. Para mais informaÃ§Ãµes sobre o Google AdSense, consulte as FAQs oficiais sobre privacidade do Google AdSense.</p>
            <p>Utilizamos anÃºncios para compensar os custos de funcionamento deste site e fornecer financiamento para futuros desenvolvimentos. Os cookies de publicidade comportamental usados por este site foram projetados para garantir que vocÃª forneÃ§a os anÃºncios mais relevantes sempre que possÃ­vel, rastreando anonimamente seus interesses e apresentando coisas semelhantes que possam ser do seu interesse.</p>
            <p>VÃ¡rios parceiros anunciam em nosso nome e os cookies de rastreamento de afiliados simplesmente nos permitem ver se nossos clientes acessaram o site atravÃ©s de um dos sites de nossos parceiros, para que possamos creditÃ¡-los adequadamente e, quando aplicÃ¡vel, permitir que nossos parceiros afiliados ofereÃ§am qualquer promoÃ§Ã£o que pode fornecÃª-lo para fazer uma compra.</p>
            <p><strong>Compromisso do UsuÃ¡rio</strong></p>
            <p>O usuÃ¡rio se compromete a fazer uso adequado dos conteÃºdos e da informaÃ§Ã£o que o Tasker oferece no site e com carÃ¡ter enunciativo, mas nÃ£o limitativo:</p>
            <ul>
                <li>NÃ£o se envolver em atividades que sejam ilegais ou contrÃ¡rias Ã  boa fÃ© e Ã  ordem pÃºblica;</li>
                <li>NÃ£o difundir propaganda ou conteÃºdo de natureza racista, xenofÃ³bica, kiwibet ou azar, qualquer tipo de pornografia ilegal, de apologia ao terrorismo ou contra os direitos humanos;</li>
                <li>NÃ£o causar danos aos sistemas fÃ­sicos (hardwares) e lÃ³gicos (softwares) do Tasker, de seus fornecedores ou terceiros, para introduzir ou disseminar vÃ­rus informÃ¡ticos ou quaisquer outros sistemas de hardware ou software que sejam capazes de causar danos anteriormente mencionados.</li>
            </ul>
            <p><strong>Mais informaÃ§Ãµes</strong></p>
            <p>Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que vocÃª nÃ£o tem certeza se precisa ou nÃ£o, geralmente Ã© mais seguro deixar os cookies ativados, caso interaja com um dos recursos que vocÃª usa em nosso site.</p>
            <p>Esta polÃ­tica Ã© efetiva a partir de 1 December 2023 23:35.</p>
        </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {

$('#cadastrarBtn').click(function (e) {
    e.preventDefault();
    
    if (!$('#aceitoTermos').prop('checked')) {
        $('#modalTermos').modal('show');
    } else {
       
        $('#aceitoTermos').prop('checked', true);
        $('form').submit(); 
    }
});

$('#aceitarTermosBtn').click(function () {
    $('#aceitoTermos').prop('checked', true);
    $('#modalTermos').modal('hide');
});
});

</script>
</body>
</html>
