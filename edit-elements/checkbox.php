<?php extract($_GET); extract($_POST); ?>

<!-- Input name -->
<div class="edit-field">
    <strong>Name (element name)</strong><br>
    <input id="element-name" type="text" value="">
</div>

<!-- Edit Label -->
<div class="edit-field">
    <strong>Label</strong><br>
    <input id="label-value" type="text" value="">
</div>

<!-- Edit Options -->
<div class="edit-field">
    <strong>Options</strong> <span class="label label-info">One per line</span><br>
    <textarea class="mt10" id="options-list"></textarea>
    <button class="btn btn-default btn-xs" id="toggle-orientation">Toggle orientation</button>
</div>

<script>
    $(function(){
        
        /*Get element name*/
        $("#element-name").val( $("#<?=$id?>").find('input[type=checkbox]').attr('name') );
        /*Set element name*/
        $("#element-name").on("keyup change",function(){
            $("#<?=$id?>").find('input[type=checkbox]').attr('name', slug( $(this).val() ) + '[]' );
        });


        /*Get label value*/
        $("#label-value").val( $("#<?=$id?>").find('label.main').html() );
        /*Set label value*/
        $("#label-value").on("keyup change",function(){
            $("#<?=$id?>").find('label.main').html( $(this).val() );
        });


        /*Get actual values*/
        var options_collector = '';
        $("#<?=$id?>").find('label:not(.main)').each(function(){

            var valor = $(this).find('input').val();
            options_collector = options_collector + valor + '\n';
            
        });
        $("#options-list").html(options_collector);

        /*Add new options*/
        var new_options_collector = '';
        $("#options-list").on("keyup change", function(){
            new_options_collector = '';
            var linea = $(this).val().split("\n");
            var row_counter = 0;
            $.each(linea, function(row){
                if( linea[row]!=='' ){
                    new_options_collector = new_options_collector + '<label><input id="<?=$id?>_'+row_counter+'" type="checkbox" value="'+linea[row]+'" name="'+ slug( $("#element-name").val() ) + '[]' +'"> ' + linea[row] + '</label>';
                    row_counter++;
                }
            });
            var label_value = '<label class="main">'+$("#label-value").val()+'</label><br>';
            $("#<?=$id?>").html( label_value + new_options_collector );
        });

        /*Toggle orientation of checkbox (.asrow) as row or column*/
        $("#toggle-orientation").click(function(){
            if(  $("#<?=$id?>").hasClass('show_as_row') ){
                $("#<?=$id?>").removeClass('show_as_row');
            }else{
                $("#<?=$id?>").addClass('show_as_row');
            }
        });
        

    });
</script>