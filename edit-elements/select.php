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

<!-- Edit Placeholder -->
<div class="edit-field">
    <strong>Predefined text</strong><br>
    <input id="placeholder-value" type="text" value="">
</div>

<!-- Edit Options -->
<div class="edit-field">
    <strong>Options</strong> <span class="label label-info">One per line</span><br>
    <textarea class="mt10" id="options-list"></textarea>
</div>

<!-- Edit Required -->
<div class="edit-field">
    <strong>Required</strong><br>
    <label style="font-weight: normal;">
        <input id="required-field" type="checkbox"> Required field
    </label>
</div>

<script>
    $(function(){
        
        /*Get element name*/
        $("#element-name").val( $("#<?=$id?>").find('select.form-control').attr('name') );
        /*Set element name*/
        $("#element-name").on("keyup change",function(){
            $("#<?=$id?>").find('select.form-control').attr('name', slug( $(this).val() ) );
        });


        /*Get label value*/
        $("#label-value").val( $("#<?=$id?>").find('label').html() );
        /*Set label value*/
        $("#label-value").on("keyup change",function(){
            var label_count = $("#<?=$id?>").find('label').length;
            if( $(this).val()=='' ){
                $("#<?=$id?>").find('label').remove();
            }else{
                if( label_count==0 ){
                    $("#<?=$id?>").prepend('<label><label>');
                }
                $("#<?=$id?>").find('label').html( $(this).val() );
            }
        });


        /*Get placeholder value (first option text)*/
        $("#placeholder-value").val( $("#<?=$id?>").find('select option').first().html() );
        /*Set placeholder value (first option text)*/
        $("#placeholder-value").on("keyup change",function(){
            $("#<?=$id?>").find('select option').first().html( $(this).val() );
        });


        /*Get actual values*/
        var counter = 0;
        var options_collector = '';
        $("#<?=$id?>").find('select option').each(function(){
            if(counter>=1){
                options_collector = options_collector + $(this).html() + '\n';
            }
            counter++;
        });
        $("#options-list").html(options_collector);


        /*Add new options*/
        var new_options_collector = '';
        $("#options-list").on("keyup change", function(){
            new_options_collector = '';
            var linea = $(this).val().split("\n");
            $.each(linea, function(row){
                if( linea[row]!=='' ){
                    new_options_collector = new_options_collector + '<option value="'+linea[row]+'">' + linea[row] + '</option>';
                }
            });
            var placeholder_value = $("#placeholder-value").val();
            $("#<?=$id?>").find('select.form-control').html('<option value="">'+ placeholder_value +'</option>' + new_options_collector);
        });


        /*Get toggle required field*/
        var is_required = $("#<?=$id?>").find('select.form-control').attr('required');
        if( typeof is_required!='undefined' ){
            $("#required-field").prop('checked',true);
        }else{
            $("#required-field").prop('checked',false);
        }
        /*Set toggle required field*/
        $("#required-field").click(function(){
            if( $(this).is(':checked') ){
                $("#<?=$id?>").find('select.form-control').attr('required', 'required');
            }else{
                $("#<?=$id?>").find('select.form-control').removeAttr('required');
            }
        });

    });
</script>
