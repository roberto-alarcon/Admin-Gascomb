$(function() {
        
        var scripts 		= document.getElementsByTagName('script');
		var lastScript 		= scripts[scripts.length - 1];
		var fullUrl 		= lastScript.src
		var domain			= fullUrl.replace("http://" , "");
		domain				= domain.split( "/" )[0];
		
        // Funcion ajax buscar folio
        $('#foliosBuscar').click( function(){

        	var folio_id_input = $('#foliosInputBuscar').val();

        	if ( folio_id_input != "" && !isNaN( folio_id_input ) )
        	{
        		
        		var loading_canvas = '<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>';
        		 $('#foliosSearchResult').html( loading_canvas );
        		$.ajax({
					  method: "POST",
					  url: "folios/search_folio",
					  data: { folio_id: folio_id_input }
					})
					  .done(function( msg ) {
					    
					    $('#foliosSearchResult').html( msg );

					  });
        			

        	}else{

        		alert("Debes inclir un número de folio válido ");
        	}
        
        });

        $('#folioAddLink').click( function(){
        		alert('Insertamos folio');
        });


      });