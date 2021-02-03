<?php extract($_GET); extract($_POST); ?>

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

<script>
    $(function(){
    	
    	/*Get label value*/
        $("#label-value").val( $("#<?=$id?>").find('strong').html() );
        /*Set label value*/
        $("#label-value").on("keyup change",function(){
        	$("#<?=$id?>").find('strong').html( $(this).val() );
        });


    	/*Get placeholder value*/
        $("#placeholder-value").val( $("#<?=$id?>").find('input[type=password]').attr('placeholder') );
        /*Set placeholder value*/
        $("#placeholder-value").on("keyup change",function(){
        	$("#<?=$id?>").find('input[type=password]').attr('placeholder', $(this).val() );
        });

    });
</script>
