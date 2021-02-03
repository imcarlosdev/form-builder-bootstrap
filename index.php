<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><!-- Viewport responsive -->

    <title>Formtastico.com - Tu constructor de formularios facilito | Your Amazing Form Builder (Por Carlos Maldonado)</title>

    <!-- Favicons & Apple Icons-->
    <link rel="shortcut icon" href="http://misitio.com/favicon.ico" />

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/helpers.css">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/app.js"></script>
    
    <!-- Default form theme -->
    <link rel="stylesheet" href="themes/default.css">


    <style>
    .ui-draggable-helper{
        list-style-type: none;
    }
    #drop-here li{
        list-style-type: none;
    }
    #drop-here .ui-sortable-placeholder{
        display: block;
        height: 30px;
        width: 100%;
        float: left;
        outline: 1px dashed #7DF780;
        background: rgba(125,247,128,.5);
        outline-offset: 2px;
        visibility: visible !important;
    }
    </style>

    <!-- jQuery UI 1.10.4 -->
    <link rel="stylesheet" href="css/jquery-ui-themes/dark-hive/jquery-ui.css">
    <script src="js/jquery-ui.min.js"></script>
    <script>
        $(function(){
            
            $("form#drop-here").submit(function(){
                return false;
            });

           
            //ORIGINAL: http://jsfiddle.net/CoolEsh/FAmk6/1/
            $("#form-elements li").draggable({
                appendTo: "body",
                connectToSortable: '#drop-here',
                helper: "clone",
                //Optional:
                start: function(e, ui){
                    //Add a classname to helper to customize in css
                    $(ui.helper).addClass("ui-draggable-helper");
                }
            });
            
            $( "#drop-here" ).droppable({accept: "#form-elements li"}).sortable({
                stop: function(e, ui){
                    var elemento_a_insertar = ui.item.find('[data-insert]').attr('data-insert');
                    $.post("insert-elements/"+elemento_a_insertar+".php",function(data){
                        ui.item.hide();
                        ui.item.replaceWith(data);
                    });
                    console.log(elemento_a_insertar);
                }
            }).disableSelection();



            /*Floating options*/
            $("#drop-here").on("click",".fire-action",function(data){
                var action = $(this).attr("data-action");

                /*Size*/
                if(action=='half'){
                    $(this).parent().parent().parent().parent().parent().removeClass('third');
                    $(this).parent().parent().parent().parent().parent().addClass('half');
                }
                if(action=='third'){
                    $(this).parent().parent().parent().parent().parent().removeClass('half');
                    $(this).parent().parent().parent().parent().parent().addClass('third');
                }
                if(action=='full'){
                    $(this).parent().parent().parent().parent().parent().removeClass('half');
                    $(this).parent().parent().parent().parent().parent().removeClass('third');
                }
                /*Remove element*/
                if(action=='remove'){
                    $(this).parent().parent().parent().parent().parent().remove();
                }
            });

            /*Send to editor*/
            $("#drop-here").on("dblclick",".xform_inner",function(data){
                var id = $(this).attr('id');
                var type = $(this).attr('data-type');
                $.post("edit-elements/"+type+".php",{id:id,type:type},function(data){
                    $("#edit-holder").slideUp(100,function(){
                        $("#edit-holder").html(data).slideDown(200);
                    });
                });
            });
           
            /*Reverse click for inputs, textareas, and selects*/
            $(".xform_inner text, .xform_inner textarea, .xform_inner select, .xform_inner button").on("dblclick",function(){
                $(this).parent().dblclick();
            });

        });
    </script>

    <!-- Habilitar HTML5 & CSS3 para navegadores antiguos -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script type="text/javascript" src="js/modernizr.min.js"></script>
    <![endif]-->
</head>
<body>

    
    <!-- Output -->
    <div id="output-wrapper" style="position: absolute; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999999999; display: none;">
        <textarea spellcheck="false" style="border: none; padding: 10px; resize: vertical; font-family: 'Lucida Console', Monaco, monospace, 'Courier New', Courier, monospace; margin:0 auto; display: block; margin-top: 30px; width: 700px; height: calc(100% - 60px); min-height: 80%; font-size: .70em;"></textarea>
    </div>
    <script>
        $(function(){
            /*Get form*/
            $("#get-code").click(function(){
                $("#loading").show();
                $.post("ajax/render.php", {html: $("#drop-here").get(0).outerHTML}, function(data){
                    $("#output-wrapper").show();
                    $("#output-wrapper textarea").val(data);
                    $("#loading").hide();
                });
            });

            $("#output-wrapper").click(function(){
                $(this).hide();
            });
            $("#output-wrapper textarea").click(function(e){
                e.stopPropagation();
            });
        });
    </script>



    <!-- Top bar -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Form Builder for Bootstrap</h2>
                <small>Developed by Carlos Maldonado</small>
            </div>
        </div>
    </div>
    <br>


    <!-- Content -->
    <div class="container">
        <div class="row">



            <!-- left --><!-- left -->
            <div class="col-md-3">
                
                <div class="panel panel-default">
                  <div class="panel-heading">Form elements</div>
                  <div class="panel-body">
                    
                    <ul id="form-elements" class="m0 p0">
                        <li> 
                            <div data-insert="simple-title" class="drag-me">
                                <img src="images/title.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="simple-text" class="drag-me">
                                <img src="images/paragraph.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="input-text" class="drag-me">
                                <img src="images/input.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="textarea" class="drag-me">
                                <img src="images/textarea.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="select" class="drag-me">
                                <img src="images/select.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="button" class="drag-me">
                                <img src="images/button.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="checkbox" class="drag-me">
                                <img src="images/checkbox.png">
                            </div>
                        </li>
                        <li> 
                            <div data-insert="radio" class="drag-me">
                                <img src="images/radio.png">
                            </div>
                        </li>
                    </ul>

                  </div>
                </div>

                
            </div>


            <!-- center --><!-- center -->
            <div class="col-md-6">
                <form id="drop-here" class="xform">
                </form>
            </div>

    
            <!-- right --><!-- right -->
            <div class="container">
                <div class="row">
                    <div class="col-md-3">

                        <div class="panel panel-default">
                            <!-- Loading animation source: https://loading.io/spinner/custom/32398/ -->
                            <div class="panel-heading">Settings <button id="get-code" class="btn btn-primary btn-xs pull-right"><img id="loading" style="position: relative; top:-2px; display: none;" src="images/loading-light.svg" height="16" width="16"> Get Code</button> </div>
                            <div class="panel-body">
                                <div id="edit-holder"><!-- Dynamic --></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</body>
</html>