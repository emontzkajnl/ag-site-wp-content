(function ($) {
    // window.params.currentRecentPage = 1;
    // let currentPopularPage = 1;
    $('.ncff-recent__btn').on('click', function() {
        const btn = $(this);
        window.params.currentRecentPage++;
        const data = {
            action: "loadMoreRecent",
            page: window.params.currentRecentPage,
            url: params.ajaxurl
        }
        $.ajax({
            type: 'POST',
            data: data,
            url: params.ajaxurl,
            dataType: 'html',
            success: function(res){
                if (res) {
                    // console.dir(res);
                    $('.ncff-recent').append(res);

                } else {
                    btn.hide();
                }
                if (currentRecentPage > maxRecentPages) {
                    btn.hide();
                }
            }
        });
    });
    $('.ncff-popular__btn').on('click', function() {
        const btn = $(this);
        window.params.currentPopularPage++;
        const data = {
            action: "loadMorePopular",
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
                    $('.ncff-popular__row').append(res);

                } else {
                    btn.hide();
                }
                if (params.currentPopularPage > maxPopularPages) {
                    btn.hide();
                }
            }
        });
    });

    let currentPage = 1;
  $('#load-more-ncff-cats').on('click', function() {
    const btn = $(this);
    currentPage++;
    // let page = btn.data('paged');
    window.params.currentpage = btn.data('paged');
    const data = {
      action: "loadMoreNcffCats",
      cat: btn.data('cat'),
      tag: btn.data('tag'),
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
          // console.dir(res);
          $('.alm-container').append(res);
          console.log('page is ', currentPage, ' max is ', window.maxpages);
          // window.params.currentpage = window.params.currentpage + 1;
          // console.log('page  is ', window.params.currentpage);
        } else {
          console.log('no res');
          btn.hide();
        }
        if (currentPage >= maxpages) {
          btn.hide();
        }
        
      }
    });
  });

  $('.sf_date_field li:first-child .sf-datepicker').attr('placeholder', 'From This Date');
  $('.sf_date_field li:nth-child(2) .sf-datepicker').attr('placeholder', 'To This Date');
})(jQuery);