  jQuery(document).ready(function($) {
      if ( $(window).width() > 768 ) {
          $('.navbar-nav > li.dropdown').hover(function () {
              $('ul.dropdown-menu', this).stop(true, true).slideDown('fast');
              $(this).addClass('open');
          }, function () {
              $('ul.dropdown-menu', this).stop(true, true).slideUp('fast');
              $(this).removeClass('open');
          });
      }
        
      $('.site-content').append('<div class="footer-visible"></div>');
      $('.site-content').append('<div class="footer-hidden"></div>');
      
      var temp = 1;
      $('.acf-block-banner .banner h2').each(function() {
          var $this = $(this);
          $this.wrapInner('<div></div>');
          setTimeout(function() {
              $this.addClass('is-visible');
          }, 250 * temp++);    
      }); 
      
      $('.acf-block-banner .banner a').wrapInner('<div></div>');
      setTimeout(function() {
          $('.acf-block-banner .banner a').addClass('is-visible');
      }, 1500);   
    
      var index = 1, w_index = 1;
    
      function splitter_letter($element, delay = 0) {
          var texts = $element.text().replace(/<\/?[^>]+(>|$)/g, '').split(' '),
              containerclass = 'splitter-mask',
              mclass = 'splitter-letter splitter-letter-' + index,
              outs = [], 
              l = '';
    
          for (var i = 0; i < texts.length; i++) {
              outs.push('<div class="' + containerclass + '"><span class="' + mclass + '" del="' + i + '">' + texts[i] + '</span></div>');
          } 
    
          l = outs.join(' ');
          $element.html(l);
          $element.show().data('index', index).data('delay', delay).addClass('splitter-wrap');
          index++;
      }
    
      $('.article .permalink, .acf-block-articles .block-title h2, .acf-block-articles .browser-link a').each(function() {
          splitter_letter($(this));
      });
    
      function create_block($element, delay = 0) {
          var aclass = 'animation-block animation-block-' + w_index;  
          $element.wrapInner('<div class="' + aclass + '"></div>');
          $element.show().data('index', w_index).data('delay', delay).addClass('animation-wrap');
          w_index++;  
      } 
    
      $('.article .post-thumbnail').each(function(index) {
        if(index > 1)
          create_block($(this));
        else
          $(this).addClass('video');
      });


      $('.article .browser-link, .article .entry-tags').each(function() {
          create_block($(this), 0.1);
      });

      $('.article .entry-title').each(function() {
          create_block($(this), 0.2);
      });

      $('.article .entry-content').each(function() {
          create_block($(this), 0.3);
      });    

      function create_content_block($element) {
          $element.show().addClass('animation-content-block');
      }

      $('.article-single').find('.post-thumbnail, .post-cats, .post-tags, .post-metas, .social-share, .entry-author, .entry-content > *').each(function() {
          create_content_block($(this));
      });

      $('.article-single').find('.entry-title, h2, h3').each(function() {
          splitter_letter($(this));
      });
    
      $('.site-footer').find('.footer-slider-area, h2, .col-md-2, .footer-desc p, .wpcf7, .footer-main .widget, .footer-main .footer-logo-area').each(function() {
          var $element = $(this),
              aclass = 'animation-fblock animation-fblock-' + w_index;
    
          $element.wrapInner('<div class="' + aclass + '"></div>');
          $element.show().data('index', w_index).addClass('animation-fwrap');
          w_index++;
      });


    
      function animation_show($block, direction, delay = 0) {
          $block.css('transition-delay', (-0.8 + delay) + 's').addClass('is-visible');
      }
    
      function animation_hide($block, direction) {
          $block.removeClass('is-visible').css('transition-delay', '0s');
      }
    
      function footer_animation($block, direction, delay = 0) {
          $block.removeClass('is-visible').css('transition-delay', '0s');
          if (direction === 'up') {
              return;
          };
    
          $block.css('transition-delay', (-0.8 + delay) + 's').addClass('is-visible');
      }

      function content_animation($block, direction, delay = 0) {
          $block.removeClass('is-visible').css('transition-delay', '0s');
          if (direction === 'up') {
              return;
          };
    
          $block.css('transition-delay', (-0.8 + delay) + 's').addClass('is-visible');
      }
      
      $(window).resize(function() {
          // footer reveal
          var obj = document.getElementById( 'wpadminbar' ),
              adminbar_height = 0;
      
          if ( obj && obj.offsetHeight && window.innerWidth > 600 ) {
              adminbar_height = obj.offsetHeight;
          }
      
          var screen_height = window.innerHeight - adminbar_height,
              footer_height = $('.site-footer').css('height', 'auto').outerHeight();
      
          if (footer_height > screen_height) {
              $('body').removeClass('footer-reveal');
              $('.site-content').css('margin-bottom', 0);
          } else {
              $('body').addClass('footer-reveal');
              $('.site-footer').css('height', screen_height);
              $('.site-content').css('margin-bottom', screen_height);
          }
          
          // refresh waypoints
          Waypoint.refreshAll();
      
          // footer slider logo
          var $wrap = $('.footer-slider'),
              $base = $('.footer-slider-base');
      
          $wrap.html('');
          do {
              $wrap.append($base.clone());
              $wrap.find('.footer-slider-base').removeAttr('style').removeClass('footer-slider-base');
          } while ($wrap.outerWidth() < window.innerWidth + $base.width());
      });

      $('.next-arrow-button').click(function() {
        $('.slick-next').click();
      })
      
      $(window).trigger('resize');
    
      // waypoints
      $('.splitter-wrap').each(function() {
          var $element = $(this);
    
          $element.waypoint({
              offset: '100%',
              handler: function(direction) {
              var $block = $('.splitter-letter-' + $element.data('index')),
                  delay = 0.05 + parseFloat($element.data('delay'));
      
              $block.removeClass('is-visible').css('transition-delay', '0s');
              if (direction === 'up') {
                  return;
              };
      
              $block.css('transition-delay', delay + 's').addClass('is-visible');
              }
          });
      });
    	
      $('.acf-block').each(function() {
          index = 0;
          $(this).find('.article .post-thumbnail').each(function() {
              var $group = $(this);
          
              $group.data('order', index++);
              $group.waypoint({
                  offset: '80%',
                  handler: function(direction) {
                      animation_show($('.animation-block-' + $group.data('index')), direction, $group.data('delay') + parseInt($group.data('order')) * 0.1 + 0.3);
                  }
              });

              $group.waypoint({
                  offset: '100%',
                  handler: function(direction) {
                      animation_hide($('.animation-block-' + $group.data('index')), direction);
                  }
              });
          });

          index = 0;
          $(this).find('.article .post-content').each(function() {
              var $group = $(this);
          
              $group.data('order', index++);
              $group.waypoint({
                  offset: '95%',
                  handler: function(direction) {
                      $group.find('.animation-wrap').each(function() {
                          var $element = $(this); 

                          animation_show($('.animation-block-' + $element.data('index')), direction, $element.data('delay') + 0.3);
                      });
                  }
              });

              $group.waypoint({
                  offset: '100%',
                  handler: function(direction) {
                      $group.find('.animation-wrap').each(function() {
                          var $element = $(this);      

                          animation_hide($('.animation-block-' + $element.data('index')), direction);
                      });
                  }
              });
          });
      });
    
      // Slick slider init
      $('[data-slick]').each(function() {
          var $this = $(this);
      
          $this.slick({
              dots: false,
              arrows: true,
              infinite: false,
              speed: 300,
              slidesToShow: 3.5,
              slidesToScroll: 1,
              adaptiveHeight: true,
              responsive: [
              {
                  breakpoint: 992,
                  settings: {
                  slidesToShow: 2.5,
                  slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 768,
                  settings: {
                  slidesToShow: 1.5,
                  slidesToScroll: 1
                  }
              }
              ]
          });
      });
    
      $('.footer-visible').waypoint({
          offset: '40%',
          handler: function(direction) {
              if (direction === 'up' || !$('body').hasClass('footer-reveal')) {
                  return;
              }
              var k = 0, set = false;
              $('.animation-fwrap').each(function() {
                  footer_animation($('.animation-fblock-' + $(this).data('index')), direction, 0.1 * k++);
              });
          }
      });
    
      $('.footer-hidden').waypoint({
          offset: '50%',
          handler: function(direction) {
              if (!$('body').hasClass('footer-reveal')) {
                  return;
              }
              $(".animation-fblock-" + index).css('transition-delay', '0s');
              $(".animation-fblock").removeClass('is-visible');
          }
      });
    
      $('.animation-fwrap').each(function() {
          var $element = $(this);
      
          $element.waypoint({
              offset: '100%',
              handler: function(direction) {
                  if ($('body').hasClass('footer-reveal')) {
                      return;
                  }
                  footer_animation($('.animation-fblock-' + $element.data('index')), direction);
              }
          });
      });

      $('.animation-content-block').each(function() {
          var $element = $(this);
      
          $element.waypoint({
              offset: '100%',
              handler: function(direction) {
                  content_animation($element, direction);
              }
          });
      });

      $(window).on('scroll', function(e) {
        $('.article-block-bg').each(function() {
          var $this = $(this),
            $next = $this.next(),
            $parent = $this.parent(),
            top = $parent[0].getBoundingClientRect().top * 0.1,
            padding_top = parseInt($parent.css('padding-top')) - 20,
            padding_bottom = parseInt($parent.css('padding-bottom')) -20;
    
          if (top > padding_top) top = padding_top;
          if (top < -padding_bottom) top = -padding_bottom;
          $(this).css('top', top);
          $parent.css('top', -top);
          $parent.css('bottom', top);
        });
        if($(window).scrollTop()){
            $('.site-header').addClass('black');
        }
        else{
            $('.site-header').removeClass('black');
        }
      });

      //drop down hover features
        $('.all-tags').hover(function () {
            $('.section-dropdown-tag ul.dropdown-menu', this).stop(true, true).slideDown('fast');
            $(this).addClass('open');
        }, function () {
            $('.section-dropdown-tag ul.dropdown-menu', this).stop(true, true).slideUp('fast');
            $(this).removeClass('open');
        });

        $('.all-tags').click(function () {
           if(!$(this).hasClass('open'))
           {
            $('.section-dropdown-tag ul.dropdown-menu', this).stop(true, true).slideDown('fast');
            $(this).addClass('open');
            $('label.all-tags i').css("transform", "rotate(180deg)");
           }
           else {
            $('.section-dropdown-tag ul.dropdown-menu', this).stop(true, true).slideUp('fast');
            $(this).removeClass('open');
            $('label.all-tags i').css("transform", "rotate(0deg)");
           }
        });

        $('.dropdown-menu').hover(function () {
            $(this, this).stop(true, true).slideDown('fast');
            $(this).addClass('open');
        });

        $('.all-categories').hover(function () {
            $('.section-dropdown-cate ul.dropdown-menu', this).stop(true, true).slideDown('fast');
            $(this).find('div').eq(0).addClass('open');
        }, function () {
            $('.section-dropdown-cate ul.dropdown-menu', this).stop(true, true).slideUp('fast');
            $(this).find('div').eq(0).removeClass('open');
        });

        $('.all-categories').click(function () {
           if(!$(this).hasClass('open'))
           {
            $('.section-dropdown-cate ul.dropdown-menu', this).stop(true, true).slideDown('fast');
            $(this).addClass('open');
            $('label.all-categories i').css("transform", "rotate(180deg)");
           }
           else 
           {
            $('.section-dropdown-cate ul.dropdown-menu', this).stop(true, true).slideUp('fast');
            $(this).removeClass('open');
            $('label.all-categories i').css("transform", "rotate(0deg)");
           }
        });
        if ( $(window).width() < 768 ) {
            $('.cate-all').parent().find("i").css("margin-bottom", "4px");
            $('.cate-all').parent().eq(0).css("margin-top", "-3rem");
        }

        $("a").attr("tabindex", "0");
        $('.slick-arrow').attr("tabindex", "0");
        $('.posts .row .col-6:nth-of-type(4)').attr("tabindex", "0");
        $('.posts .row .col-6:nth-of-type(3)').attr("tabindex", "0");
        $('input[type="text"]').attr("tabindex", "0");
        $('.posts .row .col-12').attr("tabindex", "0");
        $('.section-dropdown-cate ul li').attr("tabindex", "0");
        $('.footer-slider a:first').attr("tabindex", "0");
        $('.share').attr("tabindex", "0");
        $('.page-nav-container a:last img').attr("tabindex", "0");
        $('.col-sm-4.slick-slide').attr("tabindex", "0");
        $('#main-menu li:last').attr("tabindex", "0");
        $('.widget-title').attr("tabindex", "0");
        $('.footer-slider p').attr("tabindex", "0");
        $('a').attr("aria-label", "link");


        $('.share').on('keydown', function(e) {
          
          if (e.which == 13)
            { 
              $(this).click();
            }
        })

        $('.slick-list').parent().parent().parent().find('.next-arrow-button').attr('style', 'display:block; width:60px');
        $('.animation-wrap:last p').on('keydown', function(e) {
            if (e.which == 9)
            { 
              //window.scrollTo(10000, 10000);
              //$('.footer-slider p').focus();
              $('.next-arrow-button').focus();
            }
        })

        $('.share-linkedin:last').on('keydown', function(e) {
            if (e.which == 9)
            { 
              $('a').attr('style', 'display:none');
            }
        })
        
        $('.related-posts .animation-block-7:last a').on('keydown', function(e) {
            if (e.which == 9)
            { 
              window.scrollTo(20000, 20000);
              $('.footer-slider p').focus();
            }
        })
        
        $('.post-wrap:last .excerpt a').on('keydown', function(e) {
            if (e.which == 9)
            { 
              window.scrollTo(10000, 10000);
              $('.footer-slider p').focus();
            }
        })

        $('#post-596 .col-lg-7 .animation-block a').on('keydown', function(e) {
          if (e.which == 9)
            { 
              window.scrollTo(10000, 10000);
              $('.footer-slider-area .animation-fblock').attr("style", "padding-top:30px;");
              $('.footer-slider a:first').focus();
            }
        }) 
        $('#menu-item-8').click(function(){
          window.scrollTo(10000, 10000);
        }) 

        $('.page-nav-container a:last').on('keydown', function(e) {
            if (e.which == 9)
            { 
              window.scrollTo(10000, 10000);
              $('.footer-slider-area .animation-fblock').attr("style", "padding-top:30px;");
              $('.footer-slider a:first').focus();
            }
        })
        $('.page-nav-container a:last img').on('keydown', function(e) {
            if (e.which == 9)
            { 
              window.scrollTo(10000, 10000);
              $('.footer-slider-area .animation-fblock').attr("style", "padding-top:30px;");
              $('.footer-slider a:first').focus();
            }
        })
        $('.entry-bottom a:last').on('keydown', function(e) {
            if (e.which == 9)
            { 
              window.scrollTo(10000, 10000);
              $('.footer-slider-area .animation-fblock').attr("style", "padding-top:30px;");
              $('.footer-slider a:first').focus();
            }
        })
        $('.posts .row .col-6:nth-of-type(2) p').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('.posts .row .col-6:nth-of-type(4)').focus();
            }
        })
        $('.posts .row .col-6:nth-of-type(4) p').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('.posts .row .col-6:nth-of-type(3)').focus();
            }
        })
        $('.posts .row .col-6:nth-of-type(3) p').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('.posts .row .col-12').focus();
            }
        })

        $('.categories-section a:first').on('keydown', function(e) {
            if (e.which == 9)
            { 
              $('.section-dropdown-cate .dropdown-menu').attr('style', 'display:block');
              $('.section-dropdown-cate ul li:first').focus();
              
              if(e.shiftKey)
              {
                $('#main-menu li:last a').focus();
                $('.section-dropdown-cate .dropdown-menu').attr('style', 'display:none');
              }
            }
        })

        $('.blog-content a:first').on('keydown', function(e) {
            if (e.which == 9)
            { 
              if(e.shiftKey)
              {
                $('.section-dropdown-tag ul li:last a').focus();
                $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:block');
              }
            }
        })

        $('.section-dropdown-cate ul li:nth-of-type(1)').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('.section-dropdown-cate ul li:nth-of-type(2)').focus();
              
            }
        })
        $('.section-dropdown-cate ul li:nth-of-type(2)').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('.section-dropdown-cate ul li:nth-of-type(3)').focus();
              
            }
        })
        $('.section-dropdown-cate ul li:last').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('.section-dropdown-tag ul li:first').focus();
              $('.section-dropdown-cate .dropdown-menu').attr('style', 'display:none');
              $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:block');
              
              if(e.shiftKey)
              {
                $('.section-dropdown-cate ul li:nth-of-type(2)').focus();
                $('.section-dropdown-cate .dropdown-menu').attr('style', 'display:block');
                $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:none');
              }
            }
        })

        $('.section-dropdown-tag ul li:last').on('keydown', function(e) {
          if (e.which == 9)
          {
            $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:none');

            if(e.shiftKey)
            {
                $('.section-dropdown-tag ul li:nth-of-type(2)').focus();
                $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:block');
            }
          }
        })

        $('.section-dropdown-tag ul li:first').on('keydown', function(e) {
          if (e.which == 9)
          {
              if(e.shiftKey)
              {
                $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:none');
                $('.section-dropdown-cate ul li:last a').focus();
                $('.section-dropdown-cate .dropdown-menu').attr('style', 'display:block');
              }
          }
        })

        $('.section-dropdown-tag ul li:last a').on('keydown', function(e) {
          if (e.which == 9)
          {
              if(e.shiftKey)
              {
                $('.section-dropdown-tag .dropdown-menu').attr('style', 'display:block !important');
                $('.section-dropdown-cate ul li:nth-of-type(2)').focus();
              }
          }
        })

        $('.section-dropdown-cate ul li:nth-of-type(2)').on('keydown', function(e) {
          if (e.which == 9)
          {
              if(e.shiftKey)
              {
                $('.section-dropdown-cate ul li:first a').focus();
              }
          }
        })

        $('.section-dropdown-cate ul li:first a').on('keydown', function(e) {
          if (e.which == 9)
          {
              if(e.shiftKey)
              {
                $('.section-dropdown-cate .dropdown-menu').attr('style', 'display:none');
              }
          }
        })

        var hreflink = null;
        $('a').attr(hreflink, "href");

        $(document).on('click','a',function(){
          if($(this).data('href'))
          {
            window.location.href = $(this).data('href')
          }
        })

        $(document).on('keydown', function(e) {
          if (e.which == 9)
          {
            $('a').each(function(){
              $(this).attr('data-href',$(this).attr('href'))
            })
            $('a').removeAttr("href");
            $("a").attr("style", "cursor:pointer");
          }
          else if(e.which == 13)
          {
            $('a').each(function(){
              $(this).attr('href',$(this).data('href'))
            })
          }
        })

        $('#menu-item-8').click(function(){
          $('.navbar-close-icon').click();
        })

        $('input[type="email"]').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('input.wpcf7-submit').attr('type','text');
              $('input.wpcf7-submit').attr('style','width: 13.5rem; cursor:pointer; text-align:center;');
            }
        })
      
        $('#main-menu li.open a').attr('style','color:#6E0B1E !important');

        $('input.wpcf7-submit').on('keydown', function(e) {
            if (e.which == 9)
            {
              $('input.wpcf7-submit').attr('type','submit');
            }
            else if(e.which == 13)
            {
              $('input.wpcf7-submit').attr('type','submit');
            }
        })

        if ( $(window).width() > 768 ) {
		    $('#menu-item-dropdown-1370').attr('href','https://design.intuit.com/topics/');
		    $('#menu-item-dropdown-1370').removeAttr('data-toggle');
		    $('#menu-item-dropdown-1370').removeAttr('data-bs-toggle');
		}

		var prevScrollpos = window.pageYOffset;
		  window.onscroll = function() {

		  var currentScrollpos = window.pageYOffset;
		  if(prevScrollpos > currentScrollpos || currentScrollpos < 300)  {
		        document.getElementById("main-nav").style.top = "0";
		  } else {
		        document.getElementById("main-nav").style.top = "-100px";
		  }

		  prevScrollpos = currentScrollpos;
		}
    })   

