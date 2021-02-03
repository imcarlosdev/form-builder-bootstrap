<?php extract($_GET); extract($_POST); ?>

<!-- Edit title -->
<div class="edit-field">
    <strong>Title</strong><br>
    <input id="title-value" type="text" value="">
</div>

<div class="edit-field">
    <!-- Actions -->    
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Size <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li class="title-sizes sizeh1"><a class="fire-action" data-set-size="h1" href="#">Title H1</a></li>
        <li class="title-sizes sizeh2"><a class="fire-action" data-set-size="h2" href="#">Title H2</a></li>
        <li class="title-sizes sizeh3"><a class="fire-action" data-set-size="h3" href="#">Title H3</a></li>
        <li class="title-sizes sizeh4"><a class="fire-action" data-set-size="h4" href="#">Title H4</a></li>
      </ul>
    </div>
</div>

<script>
    $(function(){
    	
    	/*Get title value*/
        $("#title-value").val( $("#<?=$id?>").find('.title').html() );
        /*Set title value*/
        $("#title-value").on("keyup change",function(){
        	$("#<?=$id?>").find('.title').html( $(this).val() );
        });

        /*Set actual size as active*/
        var actual_size = $("#<?=$id?>").find(".title").prop("tagName").toLowerCase();
        $(".size"+actual_size).addClass('active');
        /*Change size*/
        $(".edit-field .fire-action").click(function(){
            /*set new size as active*/
            $(".title-sizes").removeClass('active');
            $(this).parent().addClass('active');
            /*set size*/
            var action = $(this).attr('data-set-size');
            if(action=='h1' || action=='h2' || action=='h3' || action=='h4'){
                $("#<?=$id?>").find(".title").replaceWith('<'+action+' class="title">'+ $("#title-value").val() +'</'+action+'>');
            }
        });

    });
</script>
