(function ($) {
    let currentPage = 1;
    $('#mfc-load-more-cats').on('click', function() {
        const btn = $(this);
        currentPage++;
        window.params.currentpage = btn.data('paged');
        const data = {
          action: "mfcloadMoreCats",
          cat: btn.data('cat'),
          tag: btn.data('tag'),
          page: currentPage
        }
        $.ajax({
          type: 'POST',
          data: data,
          url: params.ajaxurl,
          dataType: 'html',
          success: function(res){
            if (res) {
              $('.alm-container').append(res);
              console.log('page is ', currentPage, ' max is ', window.maxpages);
              // window.params.currentpage = window.params.currentpage + 1;
              // console.log('page  is ', window.params.currentpage);
            } else {
              console.log('no res');
              $('#mfc-load-more-cats').hide();
            }
            if (currentPage >= maxpages) {
              $('#mfc-load-more-cats').hide();
            }
            
          }
        });
      });

  $('.mfcrp__button').on('click', function() {
    const btn = $(this);
    currentPage++;
    const data = {
      action: "mfcloadMorePosts",
      page: currentPage,
      url: params.ajaxurl,
    }
    $.ajax({
      type: 'POST',
      data: data,
      url: params.ajaxurl,
      dataType: 'html',
      success: function(res){
        if (res) {
          $('#mfcrp__results').append(res);
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
})(jQuery);