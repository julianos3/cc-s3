function mascara(){
    var masks = ['(00) 00000-0000', '(00) 0000-00009'];
    $(".masked-phone").mask(masks[1], {onKeyPress: 
        function(val, e, field, options) {
            field.mask(val.length > 14 ? masks[0] : masks[1], options) ;
        }
    });
    $(".masked-cep").mask("99999-999");
    $(".masked-cpf").mask("999.999.999-99");
    $(".masked-cnpj").mask("99.999.999/9999-99");
    $(".masked-date").mask("99/99/9999");
    $('.masked-money').mask('000.000.000.000.000,00', {reverse: true});
};
function ajustHeightBox(){
    $('.ajustHeightBox').each(function(){
        var $this = $(this);
        $this.stop().height('auto');
        $this.stop().height($this.width());
    });
}
function ajustHeightLi(){
    $('.list-group-item ul.list-group-item-main li, .list-group-item ul li article').each(function(){
        var $this = $(this);
        $this.stop().height('auto');
        $this.stop().height($this.height());
    });
}
function hBanner(){
    var h = $(window).innerHeight() - 305;
    $('.main-banner').height(h);
}
function menuMobile(){
    $(".close-menu").live('click', function(){
        $(".main-menu ul").stop().animate({
            left:'-100%'
        }, 300);
        $(".main-menu ul").css('overflow-x','visible');
        $( 'body' ).removeAttr('style');
    });
    $(".open-menu").live('click', function(){
        $(".main-menu ul").stop().animate({
            left:'0'
        }, 300);
        $(".main-menu ul").css('overflow-x','hidden');
        $( 'body' ).height($( window ).innerHeight()).css('overflow' , 'hidden');
    });
    $(window).on('resize', function(){
        if($(window).innerWidth() < 1024){
            if($(".action-menu").hasClass('open-menu')){
                var x = $(window).innerWidth() - 10;
                $(".main-menu").children('ul').stop().animate({
                    left:'-100%'
                }, 0);
            }else{
                var x = $(window).innerWidth() - 90;
                $(".main-menu").children('ul').stop().animate({
                    left:'0%'
                }, 0);
            }
        }else{
            $(".main-menu").children('ul').stop().animate({
                left:'50%'
            }, 0);
            $(".main-menu").children('ul').css('overflow-x','visible');
            $( 'body' ).removeAttr('style');
        }
    });
};
function centerBox(){
    $(".center-box").each(function(){
        var $this = $(this);
        $this.css({'margin-left' :  'auto'});
        var x = parseFloat($this.innerWidth() / 2 + 10);
        var x = '-'+x+'px';
        if($(window).innerWidth() < 1024){
            $this.css({'margin-left' :  x , 'left' : '-100%'});
        }else{
            $this.css({'margin-left' :  x , 'left' : '50%'} );
        }
    });
};
$(document).ready(function(){
    menuMobile();
    ajustHeightLi();
    ajustHeightBox();
    hBanner();
    centerBox();
    $(window).resize(function(){
        ajustHeightLi();
        ajustHeightBox();
    centerBox();
    });
    $("map a.open-map").toggle(function(){
        $("map").height('auto');
        $(this).addClass('close-map');
        var newbox = $('map');
        $('html, body').stop().animate({ scrollTop: newbox.offset().top }, 1000);
    },function(){
        var newbox = $('map');
        $('map').stop().animate({ height: '70px' }, 500);
        $(this).removeClass('close-map');
    });
    
    $(".bx-checkbox input").click(function(){
        var $this = $(this);
        if($this.attr('checked')){
            $this.parent().find('span').addClass('bx-yellow');
        }else{
            $this.parent().find('span').removeClass('bx-yellow');
        }
    });
    $(".gallery ul article a").click(function(){
        var $this = $(this);
        if(!$this.hasClass('active')){
            $(".gallery article a").removeClass('active');
            $this.addClass('active');
            var $img = $this.attr('href');
            $(".gallery ul li.main-image figure").attr('style', 'background: url('+$img+') no-repeat;background-size: cover;background-position: center center;');
            $(".gallery ul li.main-image a.enlarge").attr('href', $img);
        }
        return false;
    });
    $(".bt-print").click(function(){
        win.print();  
        win.close();
    });

    //cadastrar newsletter
    $("#fNewsletter").submit(function(){
        var data = $(this).serialize();
        $.ajax({
            type: "POST",
            data: data,
            url: "/site/public/ajax-newsletter.php",
            dataType: "html",
            beforeSend:  function() {
                $('#msg').html("<strong class='color-white f-w-800'>Cadastrando...</strong>");
            },
            success: function(result){
                if(result == 1){
                    $('#msg').html("<strong class='color-white f-w-800'>E-mail cadastrado com sucesso!</strong>");
                    $('.limpar').val('');
                }else{
                    $('#msg').html("<strong class='color-white f-w-800'>"+result+"</strong>");
                }
            }
        });
        return false;
    });

});