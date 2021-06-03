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


    // Função que verifica se checkbox está marcado
    if ($(".admin-check").is(':checked')) {
        console.log('CHECADO!');
    }

    $(".admin-check").click(function() {
        if ($(".admin-check").is(':checked')) {
            console.log('User ' + $('.admin-check').val() + ' CHECADO!');
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
                  
                  var rotaVisualizar = $('#ver-livro').val();

                  if ( $.fn.dataTable.isDataTable( '#table-catalogo' ) ) {
                    table = $('#table-catalogo').DataTable();               
                    table.destroy();
                  }

                  $('#table-catalogo').DataTable( {
                                 
                    "data": retorno,
                    "columns": [
                   { "data": "titulo" },
                   { "data": "autor" },
                   { "data": "ano" },
                   { "data": "editora" },
                   {                            
                    "render": function(data, type, row, meta){
                        var url = '{{ url("/book/", "id") }}';
                        url = url.replace('id', row.id);

                        

                        var botoes = '<a class="btn btn-primary btn-sm" href="'+url+' "><i class="fas fa-search" data-toggle="tooltip" data-placement="top" title="Visualizar livro"></i></a>'
                                     '<a class="btn btn-succes btn-sm" href="'+url+' "><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Adicionar à estante"></i></a>';
                        return botoes;
                    }

                    },
                  
                   ],

                  //O codigo abaixo define o idioma PT_BR para a dataTable
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nenhum registro encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)",
                    "search": "Pesquisar",
                    "paginate": {
                        "next": "Próximo",
                        "previous": "Anterior",
                        "first": "Primeiro",
                        "last": "Último"
                    },
                }
        } );	
                    }
                    });
                 });

});