(function ($) {
    $('.sf_date_field li:first-child .sf-datepicker').attr('placeholder', 'From This Date');
    $('.sf_date_field li:nth-child(2) .sf-datepicker').attr('placeholder', 'To This Date');

    $('.jci-recent__btn').on('click', function(){
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
              $('.jci-recent-container').append(res);
            } else {
              btn.hide();
            }
            if (window.params.currentRecentPage >= maxPages) {
              btn.hide();
            }
          }
        });
      });

      $('.thf-contests__btn').on('click', function(){
        const btn = $(this);
        window.params.currentContestPage++;
        const maxPages = btn.data('max');
        const data = {
          action: "loadMoreContests",
          page: window.params.currentContestPage,
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
              $('.thf-contests__container').append(res);
            } else {
              btn.hide();
            }
            if (window.params.currentContestPage >= maxPages) {
              btn.hide();
            }
          }
        });
      });

      let currentPage = 1;
      $('#load-more-thf-cats').on('click', function() {
        const btn = $(this);
        currentPage++;
        // let page = btn.data('paged');
        window.params.currentpage = btn.data('paged');
        const data = {
          action: "loadMoreThfCats",
          cat: btn.data('cat'),
          tag: btn.data('tag'),
          author: btn.data('author'),
          search: btn.data('search'),
          page: currentPage,
          // page: window.params.currentpage,
          url: params.ajaxurl,
        }
        // console.dir(data);
        $.ajax({
          type: 'POST',
          data: data,
          url: params.ajaxurl,
          dataType: 'html',
          success: function(res){
            if (res) {
              console.dir(res);
              $('.alm-container').append(res);
              console.log('page is ', currentPage, ' max is ', window.maxpages);
              // window.params.currentpage = window.params.currentpage + 1;
              // console.log('page  is ', window.params.currentpage);
            } else {
              console.log('no res');
              btn.hide();
            }
            if (currentPage > maxpages) {
              btn.hide();
            }
            
          }
        });
      });
})(jQuery);