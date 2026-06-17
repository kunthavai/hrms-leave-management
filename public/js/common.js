//$.noConflict();

jQuery(document).ready(function ($) {
  
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN':
            $('meta[name="csrf-token"]').attr('content')
    }
});
 console.log(typeof bootstrap);
  const flash_element = document.querySelector('.alert-success');
  if(flash_element){
    setTimeout(() => {
      const msg = document.getElementsByClassName('alert-success')[0]; // get the first one
      if (msg) {
        msg.style.transition = 'opacity 0.5s ease-out';
        msg.style.opacity = '0';
        setTimeout(() => msg.remove(), 500);
      }
    }, 3000);
    const url = new URL(window.location.href);
    url.searchParams.delete('succMsg');
    window.history.replaceState({}, document.title, url.toString());
    }

    document.addEventListener('change', function (e) {
    if (e.target && e.target.name === 'reason') {

        

        document.getElementById('otherText').style.display =
            e.target.value === 'Other' ? 'block' : 'none';
    }
  });
  
   
    $(document).on('click', '.addCls', function (e) {       
      var url = $(this).data('url'); 
        console.log($(this).data('url'));
      
      //return false; 
        $.ajax({            
            url: url,
            type: 'GET',
            success: function (response) {
                
                $('#modalContent').html(response);
                var myModal = new bootstrap.Modal(document.getElementById('modalFade'));
                myModal.show();
               
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
     $(document).on('change', '#category_id', function (e) {
    //$('#category_id').change(function () {
        let categoryId = $(this).val();
        let baseUrl = $('#category_id').data('url');
        let url = baseUrl.replace(':id', categoryId);
        $('#quiz_id').html('<option>Loading...</option>');

        $.get(url, function (data) {
            let options = '<option value="">Select Quiz</option>';

            $.each(data, function (id, title) {
                options += `<option value="${id}">${title}</option>`;
            });

            $('#quiz_id').html(options);
        });
    });
   


  
    $(document).on('submit', '.formCls', function (e) {
        e.preventDefault();
        let form = $(this); // `this` is already the form element
        var url = form.attr('action'); 
        
        //let formData = new FormData($('#'+formId)[0]);
        
        let formData = new FormData(this);
        console.log(formData);
        
        $.ajax({
            //url: '/addTask',
            url:url,
            method: 'POST',
            data: formData,
            contentType: false, // Required for FormData
            processData: false, // Required for FormData
            success: function (response) {

              console.log("res"+response)
              //return false;
               if (response.status === false) {
                  $.each(response.errors, function (key, value) {
                  $('#error-' + key).text(value[0]);
                   
              });
              return false;
          }
             window.location.href = response.redirect_url;
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                  $('#error-' + key).text(value[0]);
              });
                console.log(errors);
            }
        });
    });
  
   
  $(document).on('click', '.actionCls', function (e) {
     e.preventDefault();
      var url = $(this).data('url'); 
      var frmAction = $(this).data('action');
      
      $.ajax({
          url: url, // defined in web.php
          type: 'GET',          
          data: {
            action: frmAction
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          success: function (response) {
              
              $('#modalContent').html(response);
              var myModal = new bootstrap.Modal(document.getElementById('modalFade'));
              myModal.show();
              
              
          },
          error: function (xhr) {
              console.error(xhr.responseText);
          }
      });
    });
    let currentFlagBtn = null;
    $(document).on('click', '.flagCls', function (e) {
     e.preventDefault();
     currentFlagBtn = this;
      var url = $(this).data('url'); 
      var attempt_id = $(this).data('id');
      var question_id = $(this).data('attempt-id');
      
      $.ajax({
          url: url, // defined in web.php
          type: 'POST',          
          data: {
            attempt_id: attempt_id,
            question_id: question_id,
            flag_action:"edit"
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          success: function (response) {
              
              $('#modalContent').html(response);
              var myModal = new bootstrap.Modal(document.getElementById('modalFade'));
              myModal.show();
              
              
          },
          error: function (xhr) {
              console.error(xhr.responseText);
          }
      });
    });
    
  });



