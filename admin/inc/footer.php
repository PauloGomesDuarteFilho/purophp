<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- script src="<?php // echo url_admin(); ?>assets/js/ie-emulation-modes-warning.js"></script -->

    <!-- /container -->    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo url_admin(); ?>assets/js/admin.js?<?=geraSenha()?>"></script>  
    <script src="<?php echo url_admin(); ?>assets/js/jquery.maskedinput.min.js?<?=geraSenha()?>"></script>  
    <script src="<?php echo url_admin(); ?>assets/js/bootstrap.min.js?<?=geraSenha()?>"></script>
    <script src="<?php echo url_admin(); ?>assets/js/holder.min.js?<?=geraSenha()?>"></script>     
    <script src="<?php echo url_admin(); ?>assets/js/ie10-viewport-bug-workaround.js?<?=geraSenha()?>"></script>
    <script src="<?php echo url_admin(); ?>assets/tinymce/js/tinymce/tinymce.min.js?<?=geraSenha()?>"></script>
    <script type="text/javascript">

        // MaskedInputJs
        $("#tel_1, #tel_2").mask("(99) 9999-9999");

        // TinyMCE
        tinymce.init({
        selector: "#conteudo",
        theme: "modern",
        paste_data_images: true,
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo paste styleselect forecolor bold italic link image media table contextmenu | alignleft aligncenter alignright alignjustify bullist numlist outdent indent",
        toolbar2: "",
        // toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        // toolbar2: "advlist autolink lists charmap print preview hr anchor pagebreak | searchreplace wordcount visualblocks visualchars code fullscreen",
        // toolbar2: "insertdatetime media nonbreaking save table contextmenu directionality",
        // toolbar3: "emoticons template paste textcolor colorpicker textpattern",
        // toolbar5: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },
        templates: [
            {
              title: 'Test template 1',
              content: 'Test 1'
            }, {
              title: 'Test template 2',
              content: 'Test 2'
            }
        ]

        });

    </script>
</body>
</html>