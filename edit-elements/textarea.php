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
    <strong>Placeholder text</strong><br>
    <input id="placeholder-value" type="text" value="">
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
        $("#element-name").val( $("#<?=$id?>").find('textarea.form-control').attr('name') );
        /*Set element name*/
        $("#element-name").on("keyup change",function(){
            $("#<?=$id?>").find('textarea.form-control').attr('name', slug( $(this).val() ) );
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


    	/*Get placeholder value*/
        $("#placeholder-value").val( $("#<?=$id?>").find('textarea.form-control').attr('placeholder') );
        /*Set placeholder value*/
        $("#placeholder-value").on("keyup change",function(){
        	$("#<?=$id?>").find('textarea.form-control').attr('placeholder', $(this).val() );
        });


        /*Get toggle required field*/
        var is_required = $("#<?=$id?>").find('textarea.form-control').attr('required');
        if( typeof is_required!='undefined' ){
            $("#required-field").prop('checked',true);
        }else{
            $("#required-field").prop('checked',false);
        }
        /*Set toggle required field*/
        $("#required-field").click(function(){
            if( $(this).is(':checked') ){
                $("#<?=$id?>").find('textarea.form-control').attr('required', 'required');
            }else{
                $("#<?=$id?>").find('textarea.form-control').removeAttr('required');
            }
        });

    });
</script>
