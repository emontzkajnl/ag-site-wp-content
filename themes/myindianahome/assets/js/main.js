(function ($) {
let currentPage = 1;
  $('#load-more-mih-cats').on('click', function() {
    const btn = $(this);
    currentPage++;
    window.params.currentpage = btn.data('paged');
    const data = {
      action: "loadMoreMihCats",
      cat: btn.data('cat'),
      tag: btn.data('tag'),
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
          $('.alm-container').append(res);
          console.log('page is ', currentPage, ' max is ', window.maxpages);
          // window.params.currentpage = window.params.currentpage + 1;
          // console.log('page  is ', window.params.currentpage);
        } else {
          console.log('no res');
          $('#load-more-mih-cats').hide();
        }
        if (currentPage >= maxpages) {
          $('#load-more-mih-cats').hide();
        }
      }
    });
  });
// most recent
$('.jci-recent__btn').on('click', function(){
  const btn = $(this);
  console.log('recent ',btn);
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

// home recipes
$('#load-more-mih-recipes').on('click', function() {
  const btn = $(this);
  window.params.currentRecipePage++;
  const maxPages = btn.data('max');
  const data = {
    action: "loadMoreRecipes",
    page: window.params.currentRecipePage,
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
        $('.mih-recipes-container').append(res);
      } else {
        btn.hide();
      }
      if (window.params.currentRecipePage >= maxPages) {
        btn.hide();
      }
    }
  });

});

// if (window.params.currentRecipePage == 'undefined') {
//   window.params.currentRecipePage = 2;
// } else {
//   console.log('recipe not undefined');
// }
// console.log('recipes are ',window.params.currentRecipePage);
})(jQuery);