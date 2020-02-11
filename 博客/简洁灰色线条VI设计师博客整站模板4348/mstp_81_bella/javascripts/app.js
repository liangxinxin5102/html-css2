jQuery(document).ready(function() {
  // module connectors configuration
  jQuery('.mod').each(function() {
    jQuery(this).attr('data-connectors', '1');
  });
});

// extend Tc.Module Class
Tc.Module = Tc.Module.extend({
  onInitStyle: function(data) {
    var $ctx = this.$ctx;

    if(data['color_scheme']) {
      $ctx.removeClass(/colorScheme.+/);
      $ctx.addClass("colorScheme"+Tc.Utils.String.capitalize(data['color_scheme']));
    }

  }
});

jQuery.extend({
  randomColor: function() {
    return '#' + Math.floor(Math.random()*256*256*256).toString(16);
  }
});

(function(removeClass) {
  jQuery.fn.removeClass = function(value) {
    if(value && typeof value.test === 'function') {
      for(var i = 0; i < this.length; i++) {
        var elem = this[i];
        if( elem.nodeType === 1 && elem.className ) {
          var classNames = elem.className.split(/\s+/);
          for(var n = 0; n < classNames.length; n++) {
            if(value.test(classNames[n])) {
              classNames.splice(n, 1);
            }
          }
          elem.className = jQuery.trim(classNames.join(" "));
        }
      }
    } else {
      removeClass.call(this, value);
    }

    return this
  }
})(jQuery.fn.removeClass);

jQuery(document).ready(function() {
  jQuery('html').removeClass('no-js');
});
(function($) {
  Tc.Module.AboutUs = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      // this.require('jquery.ui.core.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Accordion = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      this.require('jquery-ui-1.8.24.custom.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      $ctx.accordion({
        collapsible: true
      });
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.BlogPost = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      if($ctx.children('.media').length == 0) {
        $ctx.addClass('noMedia');
      }

    }
  })
})(Tc.$);
(function($) {
  Tc.Module.BlogTeaser = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.CaseStudy = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      // this.require('slides.jquery.js', 'plugin', 'onBinding');
      this.require('jquery.flexslider.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      // $('.flexslider', $ctx).flexslider({
      //   animation: 'slide',
      //   smoothHeight: true
      // });

    }
  })
})(Tc.$);
(function($) {
  Tc.Module.CommentForm = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Comments = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      // this.require('jquery.ui.core.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.ContactForm = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      this.require('jquery.validate.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      $('form', $ctx).validate({
        messages: { name: null, email: null, message: null },
        submitHandler: function(form) {
          $.ajax({
            type: 'POST',
            url: 'send.php',
            data: $(form).serialize(),
            success: function(data) {
              if(data.match(/success/)) {
                $(form).trigger('reset');
                $('.thanks', $ctx).show().fadeOut(10000);
              }
            }
          });
          return false;
        }
      });

    }
  })
})(Tc.$);
(function($) {
  Tc.Module.ContactInfo = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Copyright = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Divider = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      // this.require('jquery.ui.core.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Flickr = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      // this.require('jquery.ui.core.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Gallery = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      // $('img', $ctx).each(function() {
      //   $(this).css({
      //     'height': $(this).attr('height'),
      //     'width': $(this).attr('width')
      //   });
      // });

      // function pixelized_dimensions(resize) {
      //   $('.item > a', $ctx).css({
      //     width: '99%',
      //     height: 'auto'
      //   });

      //   if(resize) {
      //     $('.item > a', $ctx).css({
      //       width: Math.floor($('.item > a', $ctx).width()),
      //       height: Math.floor($('.item > a', $ctx).height())
      //     });
      //   }
      // }

      // pixelized_dimensions($.browser.mozilla);

      // if(!$.browser.msie) {
      //   var timer;
      //   $(window).resize(function() {
      //     clearTimeout(timer);
      //     timer = setTimeout(function() {
      //       pixelized_dimensions(true);
      //     }, 100);
      //   });
      // }

      $('.gallery-nav ul li a', $ctx).click(function() {
        $('.gallery-nav .current', $ctx).removeClass('current');
        $(this).addClass('current');

        var filter = $(this).text();

        // console.log(filter);

        if(filter == 'All') {
          $('.gallery-grid .hidden', $ctx).stop().animate({ "opacity": 1}, 1000, function() {
            $(this).removeClass('hidden');
          });
        } else {
          $('.gallery-grid .item', $ctx).each(function() {
            if($(this).hasClass(filter)) {
              $(this).stop().animate({ "opacity": 1}, 1000, function() {
                $(this).removeClass('hidden');
              });
            } else {
              $(this).stop().animate({ "opacity": 0.1 }, 1000).addClass('hidden');
            }
          });
        }


        return false;
      });

    }
  })
})(Tc.$);
(function($) {
  Tc.Module.LatestTweets = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Logo = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Member = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Nav = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      // this.require('hoverIntent.js', 'plugin', 'beforeBinding');
      // this.require('superfish.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      $('a.toggle', $ctx).click(function() {
        elem = $('.wrapper ul.nav-bar', $ctx);
        if(elem.is(':visible')) {
          elem.slideUp(400, function() {
            var style = $(this).attr('style');
            style = style.replace('display: none;', '');
            $(this).attr('style', style);
          });
        } else {
          elem.slideDown();
        }
        return false;
      });

    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Pager = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Pages = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.SectionHeader = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Service = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
    },
    onInitStyle: function(data) {
      var $ctx = this.$ctx;

      if(data['color_scheme'] == 'dark') {
        $('img[src$="_icon.png"]', $ctx).each(function() {
          var src = $(this).attr('src');
          var new_src = src.replace(/\.png$/, '_dark.png')
          $(this).attr('src', new_src);
        });
      } else {
        $('img[src$="_icon_dark.png"]', $ctx).each(function() {
          var src = $(this).attr('src');
          var new_src = src.replace(/_dark\.png$/, '.png')
          $(this).attr('src', new_src);
        });
      }
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Slider = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      this.require('jquery.flexslider.js', 'plugin', 'onBinding');
      this.require('jquery.backstretch.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      if($ctx.hasClass('testimonials')) {
        $($ctx).flexslider({
          selector: ".testimonials > blockquote",
          animation: 'slide',
          controlNav: false
        });
      } else if($ctx.hasClass('case-study')) {
        $('.flexslider', $ctx).flexslider({
          animation: 'slide',
          smoothHeight: true
        });
      } else {
        var remove_old_backstretches;
        var scroll_top_def = $.fn.scrollTop

        function rotate_bgs(slider) {
          clearTimeout(remove_old_backstretches);

          bg_images = $('.backstretch-bgs > img');
          bg_image_srcs = [];
          bg_images.each(function() {
            bg_image_srcs.push($(this).attr('src'));
          });

          if(bg_image_srcs.length == slider.count) {
            next_index = slider.currentSlide;
          } else {
            current_bg_image_src = $('.slider-bg', $ctx).data('backstretch').$img.attr('src');
            index = bg_image_srcs.indexOf(current_bg_image_src);
            next_index = index + 1;

            if (next_index == bg_image_srcs.length) {
              next_index = 0;
            }
          }

          next_src = bg_image_srcs[next_index];
          delay = 500;
          if($('html').hasClass('ie8')) {
            // hack fixing for the bug in backstretch
            $.fn.scrollTop = function() { return 100; };
          }
          $ctx.backstretch(next_src, { centeredX: true, fade: delay });
          if($('html').hasClass('ie8')) {
           $.fn.scrollTop = scroll_top_def;
          }
          // remove backstretch except the last one
          remove_old_backstretches = setTimeout(function() {
            $('.backstretch', $ctx).not(":last").remove();
          }, delay);
        }

        $('.flexslider', $ctx).flexslider({
          // animation: 'slide',
          directionNav: false,
          start: function(slider) {
            $('.backstretch-bgs > img').hide();
            src = $('.backstretch-bgs img:first').attr('src');
            $ctx.backstretch(src, { centeredX: true, fade: 500 });
          },
          after: function(slider) {
            rotate_bgs(slider);
          }
        });

      }
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Tabs = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
      this.require('jquery-ui-1.8.24.custom.js', 'plugin', 'onBinding');
    },
    onBinding: function() {
      var $ctx = this.$ctx;

      $ctx.tabs();
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Tagline = Tc.Module.extend({    
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },    
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Testimonials = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {

    },
    onBinding: function() {
      var $ctx = this.$ctx;

    }
  })
})(Tc.$);
(function($) {
  Tc.Module.Text = Tc.Module.extend({
    init: function($ctx, sandbox, modId) {
      this._super($ctx, sandbox, modId);
    },
    dependencies: function() {
    },
    onBinding: function() {
      var $ctx = this.$ctx;
    }
  })
})(Tc.$);


