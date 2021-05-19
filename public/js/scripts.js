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
})