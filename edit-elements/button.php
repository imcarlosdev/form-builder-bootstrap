<?php extract($_GET); extract($_POST); ?>

<!-- Edit Text Button -->
<div class="edit-field">
    <strong>Text</strong><br>
    <input id="button-value" type="text" value="">
</div>

<!-- Edit left or right -->
<div class="edit-field">
    <strong>Button position</strong><br>
    <label style="font-weight: normal;">
        <input id="button-position-left" value="" name="button-position" type="radio"> Left
    </label>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <label style="font-weight: normal;">
        <input id="button-position-center" value="center-block" name="button-position" type="radio"> Center
    </label>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <label style="font-weight: normal;">
        <input id="button-position-right" value="pull-right" name="button-position" type="radio"> Right
    </label>
</div>

<script>
    $(function(){
    	
    	/*Get text button value*/
        $("#button-value").val( $("#<?=$id?>").find('button.btn').html() );
        /*Set text button value*/
        $("#button-value").on("keyup change",function(){
        	$("#<?=$id?>").find('button.btn').html( $(this).val() );
        });


        /*Get button position*/
        if( !$("#<?=$id?>").find('button.btn').hasClass('pull-right') && !$("#<?=$id?>").find('button.btn').hasClass('center-block') ){
            //Left
            $("#button-position-left").prop('checked',true);
            $("#button-position-center").prop('checked',false);
            $("#button-position-right").prop('checked',false);        
        }
        else
        if( $("#<?=$id?>").find('button.btn').hasClass('center-block') ){
            //Center
            $("#button-position-left").prop('checked',false);
            $("#button-position-center").prop('checked',true);
            $("#button-position-right").prop('checked',false);
        }
        else
        if( $("#<?=$id?>").find('button.btn').hasClass('pull-right') ){
            $("#button-position-left").prop('checked',false);
            $("#button-position-center").prop('checked',false);
            $("#button-position-right").prop('checked',true);
        }
        /*Set button position*/
        $("input[name=button-position]").click(function(){
            var selected_position_classname = $(this).val();
            $("#<?=$id?>").find('button.btn').removeClass('pull-right center-block');
            $("#<?=$id?>").find('button.btn').addClass(selected_position_classname);
        });

    });
</script>
