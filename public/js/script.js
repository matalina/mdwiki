(function($) 
{
  // Reveal and Hid Javascript Items
  $('.js_reveal').css('display','block');
  $('.js_remove').css('display','none');
  
  // If logged in add Edit links
  if(AUTH) 
  {
    $('article header h1').append('<a href="#" class="edit" id="edit_title">Edit</a>');
    $('article #tags').append('<a href="#" class="edit" id="edit_tags">Edit</a>');
    $('article section').append('<a href="#" class="edit" id="edit_content">Edit</a><br class="clear"/>');
  }
  
  // On hover highlight editable areas
  $('body').on('mouseenter','.edit',function() 
  {
    $(this).parent().css('background-color', HIGHLIGHT);
  });
  
  $('body').on('mouseout','.edit',function() 
  {
    $(this).parent().css('background-color','inherit');
  });
  
  // When an edit button is clicked
  $('body').on('click','.edit',function (e) 
  {
    e.preventDefault();
    
    var $this = $(this),
      id = $this.attr('id'),
      pattern = /edit_(.+)/,
      element = pattern.exec(id);
      
      
    if(element[1] == 'title') {
      
    } else if (element[1] == 'tags') {
      
    } else if (element[1] == 'content') {
      
    }
  });
  
})(jQuery);
