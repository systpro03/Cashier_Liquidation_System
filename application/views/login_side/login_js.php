<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>

<!-- <input class="route"> -->

<script>
  

function validate_user_js(front,back)
{
   //  console.log(front,back);
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>validate_user_route',
            data: {'front': front,
                   'back': back
                  },
            dataType: 'json',
            success: function(data) {
               
               if(data.message == 'INVALID USER' && data.route == '')
               {
                  console.log('ni sulod ani');
                  Swal.fire('INVALID USER 🤪', 'Please ask for assistance to your liquidation officer before you login', 'error');
                  return;
               }
               else
               {
                  // Swal.fire('CONFIRMED USER', 'You can now input your denomination', 'success')
                  Swal.fire({
                  title: data.name,
                  iconHtml: '<img style="height: 200%; border-style: solid;" src="'+data.photo_url+'">',
                  customClass: {
                     icon: 'no-border'
                  }
                  })

                  var route = data.route;
                  
                  setTimeout(function() {
                     window.parent.location.href = "<?php echo base_url(); ?>"+route;
                    }, 1000);
               }
            
            },
            error: function(error){
               Swal.fire('NOT FOUND!', '', 'error');
            }
          });
}

</script>