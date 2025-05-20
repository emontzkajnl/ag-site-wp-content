(function ($) {
    let currentPage = 1;
    $('#load-more-cats').on('click', function() {
        const btn = $(this);
        currentPage++;
        // let page = btn.data('paged');
        window.params.currentpage = btn.data('paged');
        const maxPages = window.maxpages;
        const data = {
          action: "loadMoreCats",
          cat: btn.data('cat'),
          tag: btn.data('tag'),
          author: btn.data('author'),
          search: btn.data('search'),
          page: currentPage,
          // page: window.params.currentpage,
          url: params.ajaxurl,
        }
        console.dir(data);
        $.ajax({
          type: 'POST',
          data: data,
          url: params.ajaxurl,
          dataType: 'html',
          success: function(res){
            if (res) {
            //   console.dir(res);
              $('.alm-container').append(res);
            //   console.log('page is ', currentPage, ' max is ', window.maxpages);
              // window.params.currentpage = window.params.currentpage + 1;
              console.log('page  is ', window.params.currentpage);
            } else {
            //   console.log('no res');
              btn.hide();
            }
            if (currentPage > maxPages) {
              btn.hide();
            }
            
          }
        });
      });

      $('.fff-recent__btn').on('click', function(){
        const btn = $(this);
        window.params.currentRecentPage++;
        const maxPages = btn.data('max');
        const data = {
          action: "loadMoreRecent",
          page: window.params.currentRecentPage,
          url: params.ajaxurl,
        }
        $.ajax({
          type: 'POST', 
          data: data,
          url: params.ajaxurl,
          dataType: 'html',
          success: function (res) {
            if (res) {
              console.log(res);
              $('.fff-recent-container').append(res);
            } else {
              btn.hide();
            }
            if (window.params.currentRecentPage >= maxPages) {
              btn.hide();
            }
          }
        });
      });

      $('.fff-popular__btn').on('click', function() {
        const btn = $(this);
        window.params.currentPopularPage++;
        const data = {
            action: "loadMoreFFFPopular",
            page: window.params.currentPopularPage,
            url: params.ajaxurl,
            dataType: 'html'
        }
        $.ajax({
            type: 'POST',
            data: data,
            url: params.ajaxurl,
            dataType: 'html',
            success: function(res){
                if (res) {
                    console.dir(res);
                    $('.fff-popular__row').append(res);

                } else {
                    btn.hide();
                }
                if (params.currentPopularPage > maxPopularPages) {
                    btn.hide();
                }
            }
        });
    });

})(jQuery);