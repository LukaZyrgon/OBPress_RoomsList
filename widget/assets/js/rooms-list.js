jQuery(window).on("elementor/frontend/init", function () {
  //hook name is 'frontend/element_ready/{widget-name}.{skin} - i dont know how skins work yet, so for now presume it will
  //always be 'default', so for example 'frontend/element_ready/slick-slider.default'
  //$scope is a jquery wrapped parent element
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/RoomsList.default",
    function ($scope, $) {

       // hide hotel name if no rooms within it
       $(".rooms-per-hotel").each(function() {

        if ($(this).find(".room-card").length == 0 ) {
          $(this).find(".hotel_name").hide();
        }

      });

      function filterText(text){
        text = ''+text;
        return text.replace(/\s{2,}/g, ' ');
      }

      function searchText(query){ 

        var x = jQuery(".room-card");

        $(".rooms-per-hotel").show();

        for (var i = 0; i < x.length; i++) {   
            var locationName = filterText( jQuery(x[i]).find(".room-card-title").html() );

            var everythingText = filterText( jQuery(x[i]).find(".room-card-text-desktop").html() );

            x[i].style.display = "none"; /* hide all locations */

            /* if location matches show all hotels for that location */
            if ( locationName.toLowerCase().indexOf( query.toLowerCase() ) >= 0 || query==""){ 
              x[i].style.display = "flex";
            } else {

              /* display only locations that match search */
              if ( everythingText.toLowerCase().indexOf(query.toLowerCase()) >= 0 || query==""){ 
                /* display that location that was found */
                x[i].style.display = "flex";         
              }

            }

        } 

        // show no packages div if no results
        if($(".room-card:visible").length==0){
          $(".no-rooms").show();;
        }else{
          $(".no-rooms").hide();
        }

        $(".rooms-per-hotel").each(function() {

            if ( $(this).find(".room-card:visible").length == 0 ) {
              $(this).hide();
            } else {
              $(this).show();
            }

        });
      }     

      function reOrder(method) {
              $(".rooms-per-hotel").each(function(){

                    var cards = $(this).find(".room-card");

                    if (method == "price") { 
                        $(cards).sort(sortByPrice).appendTo(this);
                    } else if (method == "date") {
                        $(cards).sort(sortByDate).appendTo(this);
                    } else {
                        $(cards).sort(sortByFolder).appendTo(this);
                    }
              });
      }

      function sortByPrice(a, b) {
          return ( parseInt( $(b).attr("data-price") ) ) < ( parseInt( $(a).attr("data-price") ) ) ? 1 : -1; 
      }

      function sortByDate(a, b) {
          return ( parseInt( $(b).attr("data-price") ) ) < ( parseInt( $(a).attr("data-date") ) ) ? 1 : -1; 
      }

      function sortByFolder(a, b) {
          return ( parseInt( $(b).attr("data-id") ) ) < ( parseInt( $(a).attr("data-id") ) ) ? 1 : -1; 
      }

      $( document ).ready(function() {

        jQuery( "#search-input" ).keyup( function(){
          searchText( $("#search-input").val() ) 
        }); 

          /* order packages */

          $("#ordenar label").on("click", function () {

            if (  $(this).hasClass("checked") ) {
                $("#ordenar label").removeClass("checked");
            } else {
                $("#ordenar label").removeClass("checked");
                $(this).addClass("checked");
            }
          });

          $(".order-hotels").on("click", function () {

              $("#ordenar").modal('hide');
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
              $('body').css('overflow','auto');
              $('body').css('paddingRight','auto');

              if ( $("#folder").hasClass("checked") ) {
                    reOrder("folder");
              }

              if ( $("#price").hasClass("checked") ) {
                    reOrder("price");
              }

              if ( $("#date").hasClass("checked") ) {
                    reOrder("date");
              }

          });

          $("#ordenar .close , #ordenar .close-modal").on("click", function () {

            $("#ordenar label").removeClass("checked");

          });
      }); 

    }
  );
});
