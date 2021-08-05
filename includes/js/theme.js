
// make modals popup
jQuery(document).ready(function($){
  jQuery(".modal-button").click(function() {
    //find the corisponding module
     var target = $(this).data("target");
     //add a class to the html that dims the page and makes it unclickable and unscrollable
     $("html").addClass("is-clipped");
     //add the active class to the modal to make it visible
     $(target).addClass("is-active");
     //changes the aria-hidden value of the modal from true to fasle
     $(target).attr('aria-hidden', 'false');
  });
  jQuery(".modal-close").click(function() {
    //removes the clipped class from the hml when the close modal button is clicked
     $("html").removeClass("is-clipped");
     //removes the active class from the modal, hidding it
     $(this).parent().removeClass("is-active");
     //changes the aria-hidden value of the modal from false to true
     $(this).parent().attr('aria-hidden', 'true');
  });
  //close the modal by clicking outside the modal itself
  jQuery(".modal-background").click(function() {
    //removes the clipped class from the hml when the the user clicks anywhere other than the modal
     $("html").removeClass("is-clipped");
     //removes the active class from the modal when the the user clicks anywhere other than the modal, hidding it
     $(this).parent().removeClass("is-active");
     //changes the aria-hidden value of the modal from false to true when the the user clicks anywhere other than the modal
     $(this).parent().attr('aria-hidden', 'true');
  });
});
