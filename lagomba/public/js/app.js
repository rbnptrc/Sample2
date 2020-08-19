$(document).ready(() => {

  // Removing the success message by add, edit, delete after 4 seconds
  setTimeout(() => {
    $('#alert-message').slideUp('slow', () => { 
        $('#alert-message').remove();});
}, 4000);
})