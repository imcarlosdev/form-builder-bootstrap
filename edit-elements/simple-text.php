<?php extract($_GET); extract($_POST); ?>

<!-- Edit text -->
<div class="edit-field">
    <strong>Text</strong><br>
    <textarea id="text-value"></textarea>
</div>

<script>
    $(function(){
    	
    	/*Get text value*/
        var current_text = $("#<?=$id?>").find('.text').html();
        current_text = current_text.replace(/<br>|<br\/>|<br\s\/>/g,"\r");
        $("#text-value").val( current_text );

        /*Set modified text value*/
        $("#text-value").on("keyup change",function(){
            var modified_text = $(this).val();
            modified_text = modified_text.replace(/(\r\n|\n|\r)/g,"<br />");
        	$("#<?=$id?>").find('.text').html( modified_text );
        });

    });
</script>
