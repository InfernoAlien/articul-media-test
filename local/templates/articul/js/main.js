$(document).on("click", ".js-page-nav", function(e) {
   e.preventDefault();

   var ajax_url = $(this).attr("href");

   $.ajax({
      url: ajax_url,
      type: "POST",
      data: {IS_AJAX: 'Y'},
      success: function(data) {
         $(".js-users-list").html(data);
      }
   });
});

$(document).on("click", ".js-export", function(e) {
   e.preventDefault();

   const href = $(this).attr("href");

   var ajax_url = window.location.href;

   $.ajax({
      url: ajax_url,
      type: "POST",
      data: {
         IS_AJAX: 'Y',
         EXPORT_TYPE: $(this).data('type')
      },
      success: function(data) {
         var link = document.createElement('a');
         link.setAttribute('href', href);
         link.setAttribute('download', "");
         link.click();

         link.remove();
      }
   });
});