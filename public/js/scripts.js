$(function(){
    // Aqui vai todo o código JavaScript.
    
    // Código menu de navegação
    $('nav.mobile').click(function(){
        // O que vai acontecer quando clicarmos na nav.mobile
        var listaMenu = $('nav.mobile ul');
        
        // Abrir/ fechar menu através do fadeIn
        /*if(listaMenu.is(':hidden') == true){
            listaMenu.fadeIn();
        } else {
            listaMenu.fadeOut();
        }*/

        // Abrir/ fechar menu através do slideToggle
        //listaMenu.slideToggle();

        // Abrir/ fechar menu com slideToggle e mudar símbolo
        // após aberto
        if(listaMenu.is(':hidden') == true){
            //fas fa-bars
            //fas fa-times
            //var icone = $('.botao-menu-mobile i');
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-bars');
            icone.addClass('fa-times');
            listaMenu.slideToggle();
        } else {
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-times');
            icone.addClass('fa-bars');
            listaMenu.slideToggle();
        }
    })

    // Código seta scroll down página
    // $('div.setaDescer').click(function(event){
    //     event.preventDefault();
    //     var n = $(document).height();
    //     $('html, body').animate({ scrollTop: n }, 1000);
    // });

    // Scroll dinâmico para elemento de acordo com target
    
    
    
    $('div.setaDescer').click(function(){
        if($('target').length > 0) {
            // O elemento existe, portanto, precisamos dar scrool em algum elemento
            var elemento = '#'+$('target').attr('target');
            var divScroll = $(elemento).offset().top;
            $('html,body').animate({'scrollTop':divScroll});
        }
    })

    // Abrir modal adicionar livro à estante
    $("#btn-modal-add-livro").click(function(){
        $("#modalAddLivro").modal('toggle');
    });

    // Fechar modal adicionar livro à estante
    $("#btn-close-01").click(function() {
        $("#modalAddLivro").modal('toggle');
    });

    // Fechar modal adicionar livro à estante
    $("#btn-close-02").click(function() {
        $("#modalAddLivro").modal('toggle');
    });

    // Abrir modal troca status
    $(".tag-status").click(function() {
        $("#modalTrocaStatus").modal('toggle');
    });

    // Fechar modal troca de status
    $("#btn-close-03").click(function() {
        $("#modalTrocaStatus").modal('toggle');
    });

    // Fechar modal troca de status
    $("#btn-close-04").click(function() {
        $("#modalTrocaStatus").modal('toggle');
    });

    // Abrir modal troca de status em estante-detalhe
    $("#btn-modal-troca-status").click(function(){
        $("#modalTrocaStatus").modal('toggle');
    });

    // Abrir modal edição de conta
    $("#btn-user").click(function(){
        $("#modalUser").modal('toggle');
    });

    // Fechar modal edição de conta
    $("#btn-close-user-01").click(function(){
        $("#modalUser").modal('toggle');
    });

    // Fechar modal edição de conta
    $("#btn-close-user-02").click(function(){
        $("#modalUser").modal('toggle');
    });

    

    // Menu dropdown ADMIN
    $(".dropdown").click(function(){
        // O que vai acontecer quando clicarmos na nav.mobile
        //alert('Olá!');
        var listaMenu = $('.dropdown div');
        
        if(listaMenu.is(':hidden') == true){
            listaMenu.slideToggle();
            $('.dropdown-content').style.display = "block";
        } else {
            listaMenu.slideToggle();
        }
    });

    // Função que chama modal e faz requisição para troca de status
    $(document).on('click', '#pesquisarStatus', function(e){
        let url = $(this).data('href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    : "POST",
            url     : url,
            success : function(retorno) {
              console.log(retorno);

                  
                 

                }

            });
        });

})