<script type="text/javascript">
    $(document).ready(function(){
        themeLink();
        themeButton();
        themeText();
    });
    function themeLink() {
        $('a').hover(function(){
            $(this).css({'color':'#FF6347'});
        }, function(){
            $(this).css({'color':'#1E90FF'});
        });
    }
    function themeButton() {
        $('input[type=button],button').hover(function(){$(this).css({
            'color':'#4169E1',
            'box-shadow':'0px 0px 5px #1E90FF',
            '-moz-box-shadow':'0px 0px 5px #1E90FF',
            '-webkit-box-shadow':'0px 0px 5px #1E90FF',
            'text-shadow':'0px 0px 5px #1E90FF'
        });}, function(){$(this).css({
            'color':'#232323',
            'box-shadow':'none',
            '-moz-box-shadow':'none',
            '-webkit-box-shadow':'none',
            'text-shadow':'none'
        });});
    }
    function themeText() {
        var txt=$('input[type=text],input[type=password],textarea');
        $(txt).focus(function(){$(this).css({
            'box-shadow':'inset 0px 0px 10px #232323',
            '-moz-box-shadow':'inset 0px 0px 10px #232323',
            '-webkit-box-shadow':'inset 0px 0px 10px #232323'
        });});
        $(txt).blur(function(){$(this).css({
            'box-shadow':'inset 0px 0px 5px #232323',
            '-moz-box-shadow':'inset 0px 0px 5px #232323',
            '-webkit-box-shadow':'inset 0px 0px 5px #232323'
        });});
    }
</script>
