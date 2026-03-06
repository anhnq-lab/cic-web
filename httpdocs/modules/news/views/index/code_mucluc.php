<?php if ((strpos($data->content, 'h2') == true)) { ?>
                    <div class="row">
                        <div class=" col-md-8">
                            <div class="toc-content rounded mb-4" id="left1">
                                <div class="title-toc-list d-flex justify-content-between p-3">
                                    <h3 class="title-toc"><i class="fa fa-bars mr-1"></i><span class="title"><?php echo FSText::_('Nội dung chính') ?></span></h3>
                                    <span class="button-select">
                                        <span class="tablecontent none">
                                            <img src="/images/index.svg" alt="mục lục">
                                        </span>
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </div>
                                <div class="list-toc">
                                    <ol id="toc" class="p-3 pb-0"></ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php } ?>
				
				JS: https://didongthongminh.vn/modules/news/assets/js/jquery.toc.js/jquery
				
				<style>
				.toc-content {
  .title-toc {
    margin-top: 8px;
    font-size: 17px;
    font-weight: 600;
    color: $color_19;
    .fa {
      padding-right: 5px;
    }
  }
  max-width: 500px;
  background: #f3f3f3;
  padding: 1px 6px;
  margin-top: 10px;
  border-radius: 5px;
  border: 1px solid #ddd;
  .title-toc-list {
    background: #EEEEEE;
    display: flex;
    align-items: center;
    padding: 15px;
    justify-content: space-between;
    .title-toc {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 0;
      margin-top: 0;
      i {
        margin-right: 10px;
      }
    }
    .none {
      display:none;
    }
    .button-select {
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      text-transform: uppercase;

      i {
        margin-left: 14px;
        transition: 0.1s ease-in-out;
        font-size: 20px;
        font-weight: bold;
      }
      i.active {
        transform: scale(1, -1);
      }
    }
  }
  .list-toc {
    background: #fff;
    display: none;
    ol {
      margin-bottom: 0;
      counter-reset: my-awesome-counter;
      list-style: none;
      padding: 5px 10px;
      >li {
        counter-increment: my-awesome-counter;
        list-style-position: inside;
        margin-right: 0;
        padding-bottom: 5px;
        font-size: 17px;
        line-height: 25px;
        padding: 5px 0;
        font-weight: 600;
        color:#157a71;
        a {
          color:#157a71;
        }
        ol {
          li {
            font-weight: 600;
            font-size: 16px;
            list-style: decimal;
            color: #007eff;
            a {
              color: #007eff;
            }
            ol {
              counter-reset: item;
              li {
                display: block;
                font-size:15px;
                font-weight: normal;
                color:#444;
                a {
                  color:#444;
                  font-weight: 600;
                  font-size: 17px;
                }
                ol li {
                  list-style:disc;
                  color:#666;
                  a {
                    color:#666;
                    font-weight: normal;
                  }
                }
              }
              li:before { content: counters(item, ".") " "; counter-increment: item }
            }

          }
        }
        &:before {
          content: counters(my-awesome-counter, ".") ". ";
          display: none;
        }
        a {
          color: $color_4;
          text-decoration: none;
        }
      }
    }
    >ol {
      >li {
        &:before {
          font-weight: bold;
        }
      }
    }
    #toc {
      padding: 15px;
      background: #f7f7f7;
    }
  }
  ol {
    li {
      a {
        margin-bottom: 7px;
      }
    }
  }
}
</style>
				<script>
				$(document).ready(function () {
    $("#toc").toc({content: ".description", headings: "h1,h2,h3,h4"});
    $(".button-select").click(function() {
        $('.fa-angle-down').toggleClass('active');
        $('.title-toc .title').addClass('display');
        $('.mr-1').toggleClass('active');
        $('.list-toc').slideToggle();
    });

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
       
        if (scroll >= 700) {
            $("#left1").addClass("fixtoc");
            $('.fa-angle-down').removeClass('active');
            $('.tablecontent').removeClass('none');
            $(".fa-angle-down").addClass("none");
            $(".mr-1").addClass("none");
            
        }
        if (scroll < 700) {
            $("#left1").removeClass("fixtoc");
            $('.tablecontent').addClass('none');
            $('.fa-angle-down').removeClass('none');
            $(".mr-1").removeClass("none");
        }
    });

    $('#toc a').on('click',function (e) {
        e.preventDefault();
        let target = $(this).attr('href');
        target = target.replace(/\./g,'\\.');
        $('html, body').animate({
            'scrollTop': $(target).offset().top - 60
        }, 800);
    });

    
});
</script>