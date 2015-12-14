jQuery(function($){

	$.datepicker.regional['pt-BR'] = {
	    closeText: 'Fechar',
	    prevText: '&#x3c;Anterior',
	    nextText: 'Pr&oacute;ximo&#x3e;',
	    currentText: 'Hoje',
	    monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun', 'Jul','Ago','Set','Out','Nov','Dez'],
	    dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
	    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	    weekHeader: 'Sm',
	    dateFormat: 'dd/mm/yy',
	    firstDay: 0,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''};
    	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);

	//DEFININDOP DATEPICKER
    //$("#datahora").datepicker();

    //TELEFONE
    $("#telefone, #othertelefone").mask("(99) 9999-9999");
    $("#datahora").mask("99/99/9999");
    $("#horario").mask("99:99");

	//TOTOP
	$(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$("#top ul:first-child").hide();
			$("#toTop, #menu-fixed").fadeIn();
		} else {
			$("#top ul:first-child").show();
			$("#toTop, #menu-fixed").fadeOut();
		}
	});

	//BACK TO TOP
	$("#toTop").click(function () {
	//1 second of animation time
	//html works for FFX but not Chrome
	//body works for Chrome but not FFX
	//This strange selector seems to work universally
	$("html, body").animate({scrollTop: 0}, 2000);
	});

	$("#ul-menu li.atvdo").mouseover(function(){
	    $('.insub-menu').show();
	});
	$("#ul-menu li.atvdo").mouseout(function(){
	    $(".insub-menu").hide();
	});

	// POPUP OPEN POP
	$('.open-popup-link, .open-popup-address-link, .open-popup-agenda-link, .open-popup-verpreco-link').magnificPopup({
	  	type:'inline',
	  	midClick: true
	});

	//SLIDER
	$("#banner").slidesjs({
		width: 960,
		height: 440,
	});			

	//DEPOIMENTOS
	$("#deps").slidesjs({
		width: 960,
		height: 260,
	});	

	//DEPOIMENTOS SUF		
	$("#depoimentos-suf").slidesjs({
		width: 588,
		height: 200,
	});

	//DEPOIMENTOS
	$("#depsi").slidesjs({
		width: 276,
		height: 260,
	});

	//TRATAMENTOS
	$('.intratamento').slick({
		centerMode: 		true,
		centerPadding: 		'30px',
		slidesToShow: 		3,
		arrows: 			true,
		prevArrow: 			'<button type="button" class="slick-prev slickimglcustom"><img src="imagens/arrow-left.png" alt="" /></button>',
		nextArrow: 			'<button type="button" class="slick-next slickimgrcustom"><img src="imagens/arrow-rigth.png" alt="" /></button>',
		prevArrowkey: 		"default",
		nextArrowKey: 		"default",
	});

	//IMPRENSA
	$('.videos-dental').slick({
		arrows: 			true,
		prevArrow: 			'<button type="button" class="slick-prev slickimglcustom"><img src="imagens/arrow-left.png" alt="" /></button>',
		nextArrow: 			'<button type="button" class="slick-next slickimgrcustom"><img src="imagens/arrow-rigth.png" alt="" /></button>',
		prevArrowkey: 		"default",
		nextArrowKey: 		"default",
	});

	//FAQ
	$(".ativar").on("click", function( e ){

		e.preventDefault();

		if( $(this).hasClass('ativado') ){

			// Tentando desativar todo mundo
			$(this).
				removeClass(' ativado').
				attr("src", "imagens/acessa-servico-desativado.png").
				parents(".question").children('.resposta').
				removeClass('active');
			
		} else {

			// Tentando ativar alguém
			$(".resposta").removeClass("active");
			$(".ativar").removeClass("ativado");
			$(".ativar").attr("src", "imagens/acessa-servico-desativado.png");

			$(this).
				addClass(' ativado').
				attr("src", "imagens/acessa-servico-ativado.png").
				parents(".question").children('.resposta').
				addClass('active');

		}

	});

	$("#tcidades").on('change', function(){
		// Pegando o ID do estado para chamar as clínicas
		// idclinica = $('#tcidades option:selected').val();
		formulario = $(this).serialize();
		if(formulario != null && formulario != ""){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/includes/functions.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$("#todas_clinicas").empty();
		       		$('#todas_clinicas').append(data);
		       		// console.log(data);
		       },
		       error : function(data){
					window.location = '/home';
		       }

		    });

		}

	});

	$("#agendarpopup").on('submit', function( event ){

		event.preventDefault();
		formulario = $(this).serialize();

		console.log(formulario);

	    $.ajax({
	       url : 'http://dent.axitech.com.br/includes/functions.php',
	       type : 'POST',
	       dataType : 'html',
	       data : formulario,
	       success : function(data){
	       		$("#msg").append(data);
	       		//$('#todas_clinicas').append(data);
	       		//console.log(data);
	       },
	       error : function(data){
				window.location = '/home';
	       }

	    });

	});

});