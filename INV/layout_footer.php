    </div>
    <!-- /container -->
  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
  <script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
  
    var id = $(this).attr('delete-id');
  
    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        size: "small",
        centerVertical: true,
        buttons: {
            confirm: {
                label: 'Yes',
            },
            cancel: {
                label: 'No',
            }
        },
        callback: function (result) {
  
            if(result==true){
                $.post('delete_product.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });
  
    return false;
});
</script>
</body>
</html>