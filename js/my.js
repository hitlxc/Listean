//先导入jQuery。。
$(function() {

    $("#hid").bind("click",function(){
        $("#div_img").hide("slow");
    });
    $("#show").bind("click",function(){
          $("#div_img").show("slow");
    });


    switch($(".hidden").eq(0).attr("id")) {
        case 'index':
            console.log('1');
            break;
        case 'reg':
            $(function(){
                console.log('2');
                $(".start_button").eq(0).bind("click",function(){
                    $(".pure-form").eq(0).hide("fast");
                    $(".pure-form").eq(1).show("fast");
                });
                $(".start_button").eq(1).bind("click",function(){
                    $(".pure-form").eq(1).hide("fast");
                    $(".pure-form").eq(0).show("fast");
                })
             })
            break;
        case 'list':
            console.log('3');

            $(".del_button").each(function(){
                $(this).bind("click",function(){
                    $(this).parents(".pure-g").hide("fast");
                });
            });

            $(".liu_button").each(function(){
                $(this).one('click',function(){
                    // $(this).parents(".pure-g").find(".liuyan").show("fast");
                    var tag = $(this).parents(".pure-g");
                    var id = tag.find('.hidden').val();
                    $.post("?/home/get_liuyan",{
                        'id':id
                    },
                    function(data){
                        var obj = JSON.parse(data);
                        // console.log(obj);
                        var lyb = tag.find(".liuyan_body");
                        for (var i = obj.length - 1; i >= 0; i--) {
                            var b_name = $("<b></b>").text(obj[i].user_id+":");
                            // var p_liuyan = document.createElement('p');

                            var txt1 =$("<p></p>").text(obj[i].body);
                            txt1.prepend(b_name);
                            lyb.prepend(txt1);
                        }


                        tag.find(".liuyan").show("fast");
                    });
                });
            });

            $("form button[type=submit]").click(function(){
                $.post("?/home/has_login",function(data){
                    if(data == 0)
                        alert("you must login first~");
                })
            });

            $(".play").each(function(){
                $(this).click(function(){
                    var au = $(this).siblings("audio")[0];
                    if(au.paused)
                    {
                        au.play();
                    }
                    else
                    {
                        au.pause();
                        au.currentTime = 0;
                    }
                })
            });

            break;

        case 'record':
            console.log(4);

            $("button").click(function(){
                $.post("?/home/has_login",function(data){
                    if(data == 0)
                    {
                        alert("you must login first~");
                        window.location.href="?/home/start";
                    }
                })
            });

            break;
    }


});