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
    $("#btn-editar-dados").click(function(){
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

    // Abrir modal exclusão conta
    $("#btn-deletar-conta").click(function() {
        $("#modalDeleteUser").modal('toggle');
    });

    // Fechar modal exclusão conta
    $("#btn-close-delete-01").click(function() {
        $("#modalDeleteUser").modal('toggle');
    });
    
    // Fechar modal exclusão conta
    $("#btn-close-delete-02").click(function() {
        $("#modalDeleteUser").modal('toggle');
    });

    

    // Abrir modal exclusão livro da estante
    $(".btn-exclusao-estante").click(function() {
        $("#modalExclusaoEstante").modal('toggle');
        var id = $(this).attr('data-href');
        $("#deleteId").val(id);
    });

    // Fechar modal exclusão livro da estante
    $("#btn-close-est-01").click(function() {
        $("#modalExclusaoEstante").modal('toggle');
    });
    
    // Fechar modal exclusão livro da estante
    $("#btn-close-est-02").click(function() {
        $("#modalExclusaoEstante").modal('toggle');
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
              console.log(retorno.status_id);
              
              $('#status').html('Carregando...')
              .find('option')
              .remove()
              .end();
              
              $.each(retorno,function(key, value){
                $('#user_livro_id').val(value.users_livro_id);
                $('#status').append('<option value="' + value.status_id + '">' + value.status + ' </option>');
                if (value.status_id == 1) {
                    $('#status').append('<option value="' + 2 + '">' + ' Lendo ' + ' </option>');
                    $('#status').append('<option value="' + 3 + '">' + ' Quero ler ' + ' </option>');
                } else if(value.status_id == 2) {
                    $('#status').append('<option value="' + 1 + '">' + ' Lido ' + ' </option>');
                    $('#status').append('<option value="' + 3 + '">' + ' Quero ler ' + ' </option>');
                } else {
                    $('#status').append('<option value="' + 1 + '">' + ' Lido ' + ' </option>');
                    $('#status').append('<option value="' + 2 + '">' + ' Lendo ' + ' </option>');
                }
              });
            }

            });
        });

       
        // Clique do checkbox
        // Verificação se está marcado (é admin) ou não
        // Exibe "conceder acesso" para não admin
        // E exibe "revogar acesso" para admin

        $(".admin-check").click(function() {
            if($(this).prop("checked") == true){
                console.log("Checkbox is now checked.");
                $("#modalAdmin").modal('toggle');
                var id = $(this).attr('data-href');
                $("#is_admin_id").val(id);
            }
            else if($(this).prop("checked") == false){
                console.log("Checkbox is now unchecked.");
                $("#modalNotAdmin").modal('toggle');
                var id_not = $(this).attr('data-href');
                $("#is_not_admin_id").val(id_not);
            }
        });

        // Abrir modal exclusão livro da estante
    $(".btn-exclusao-estante").click(function() {
        $("#modalExclusaoEstante").modal('toggle');
        var id = $(this).attr('data-href');
        $("#deleteId").val(id);
    });

        // Fechar modal conceder acesso admin
        $("#btn-close-admin-01").click(function() {
            $("#modalAdmin").modal('toggle');
        });

        // Fechar modal conceder acesso admin
        $("#btn-close-admin-02").click(function() {
            $("#modalAdmin").modal('toggle');
        });

        // Fechar modal revogar acesso admin
        $("#btn-close-admin-03").click(function() {
            $("#modalNotAdmin").modal('toggle');
        });

        // Fechar modal revogar acesso admin
        $("#btn-close-admin-04").click(function() {
            $("#modalNotAdmin").modal('toggle');
        });


        // Pesquisa catálogo
        $(document).on('click', '#btn-pesquisa', function(){
            let url = $(this).data('href');
            console.log(url);

            $.ajax({
                type    : "POST",
                url     : url,
                data	: $("#pesquisaCatalogo").serializeArray(),
                success : function(retorno) {
                  console.log(retorno);
                  $("#div-tabela-catalogo").html(retorno);
                
                  $('#table-catalogo').DataTable({
                    language:{
                        url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
                    },
                  });
                },
                beforeSend: function() { 
                    $('#carregar').html("<img src='/img/preloader.gif' style='width: 40px;' style='display: none; text-align: center;'> CARREGANDO");
                },  
                complete: function(){ 
          
                   $('#carregar').html("");		  
                },		
                error	: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert_error("Erro, Desculpe!");
                }

            });
        });

        // Deixar a combo com pesquisa dinâmica
        $('#autor-catalogo').select2({
            theme: 'bootstrap4'
        });

        $('#titulo-catalogo').select2({
            theme: 'bootstrap4'
        });

        $('#assunto-catalogo').select2({
            theme: 'bootstrap4'
        });

        $('#editora-catalogo').select2({
            theme: 'bootstrap4'
        });

        // Função limpar pesquisa
        $('#btnLimpar').click(function(){
            $('select').find('option').prop('selected', function() {
              return this.defaultSelected;
        });

        $('select').trigger('change.select2');

        });

        // DataTable tabela livros (admin)
        $('#data-table-livros').DataTable({
            language:{
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
            },
        });
        
        // DataTable tabela gestão de usuários (admin)
        $('#data-table-usuarios').DataTable({
            language:{
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
            },
        });

        // DataTable tabela autores (admin)
        $('#data-table-autores').DataTable({
            language:{
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
            },
        });
        
        // DataTable tabela assuntos (admin)
        $('#data-table-assuntos').DataTable({
            language:{
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
            },
        });

        // DataTable tabela editoras (admin)
        $('#data-table-editoras').DataTable({
            language:{
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
            },
        });

});