$(function(){
  'use strict';

  var
    // Extension wrapper
    $wrapper = $('.tx-marketplace'),
    $ratingStars = $('input.ratingStars', $wrapper),

    // Class of validation errors in forms
    errorClass = 'f3-form-error',
    ratingOptions = {
      // size: 'xs',
      // theme: 'krajee-svg',
      showClear: 0,
      showCaption: 1,
      hoverChangeStars: false,
      emptyStar: '<i class="fa fa-certificate"></i>',
      filledStar: '<i class="fa fa-certificate"></i>',
      starCaptions: function(val){
        return val + ' Suns';
      },
      starCaptionClasses: function(val) {
          if (val <= 2) {
              return 'label label-default';
          }
          else if (val <= 4) {
              return 'label label-success';
          }
          else {
              return 'label label-primary';
          }
      },
      min: 0,
      max: 5,
      step: 1,
      stars: 5
    },
    ratingDisplay = {
      displayOnly: true,
      // theme: 'krajee-svg',
      emptyStar: '<i class="fa fa-certificate"></i>',
      filledStar: '<i class="fa fa-certificate"></i>',
      // size: 'xs',
      min: 0,
      max: 5,
      step: 0.5,
      stars: 5
    },

    // Options for affix
    affixOptions = {
      offset: {
        top: 100,
        // bottom: function () {
        //   return (this.bottom = $('.footer').outerHeight(true))
        // },
        bottom: 0
      },
     target: $wrapper
    },

    // JS hider
    $hider = $('.js-hide').hide(),

    // Filter container
    $filter = $('.filter', $wrapper),

    // Special filter options
    // that trigger the filter as they change
    $noradios = $('.no-radios .radio, .no-radios .checkbox', $filter),

    // Sort by select
    $sortBy = $('.sortby-select select', $wrapper)
  ;

  // If rating stars are on the page
  if($ratingStars.length) {
    var
      $readOnlyStars = $ratingStars.filter('.ratingRead'),
      $restStars = $ratingStars.filter(':not(.ratingRead)')
    ;

    $readOnlyStars.rating(ratingDisplay);
    $restStars.rating(ratingOptions);

    // Validation errors for suns/stars
    $ratingStars.each(function(){
      if($(this).hasClass(errorClass)){
        $(this).parent('.rating-container').addClass(errorClass);
        $(this).closest('.ratingContainer').addClass(errorClass);
      }
    });

    $('.rating-container')
      .each(function(){
        var v = ($('input', $(this)).val() < ratingOptions.max) ? $('input', $(this)).val() / ratingOptions.max * 100 : 0;
        if(v = 5){
          v -= 5;
        } else {
          v -= 0;
        }
        $('.filled-stars', $(this)).css({width: v+"%"});
      })
      .mouseenter(function(){
        $(this).attr('title', $('input', $(this)).val());
    });

    $('a[href="#collapseDescription"]').click(function(){
      $(this).toggleClass('buttonText-unshow').toggleClass('buttonText-show');
    });
  }

  // Clear input handling
  $('.has-clear input').on('change', function() {
          if ($(this).val() == '') {
              $(this).parents('.form-group').addClass('has-empty-value');
          } else {
              $(this).parents('.form-group').removeClass('has-empty-value');
          }
      }).trigger('change');

      $('.has-clear .form-control-clear').on('click', function() {
          var $input = $(this).parents('.form-group').find('input');

          $input.val('').trigger('change');

          // Trigger a "cleared" event on the input for extensibility purpose
          $input.trigger('cleared');
      });

  // Sort by select
  $sortBy.on('change', function(){
    $(this).closest('form').submit();
  });

  // Filter is available
  if($filter.length){

    // Change radio/check => submit form
    $noradios.change(function(e){
      console.log($('form', $filter).first());
      $('form', $filter).first().submit();
    });
  }

  $(".panel").on("show.bs.collapse hide.bs.collapse", function(e) {
    if (e.type=='show'){
      $(this).addClass('active');
    }else{
      $(this).removeClass('active');
    }
  });
  $(".panel .collapse.in").each(function(){
    $(this).closest('.panel').addClass('active');
  });

});
