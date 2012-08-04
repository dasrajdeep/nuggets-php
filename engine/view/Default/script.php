<script type="text/javascript">
    $(document).ready(function(){
        $('.loader').hide();
        themeLink();
        themeButton();
        themeText();
    });
    function themeLink() {
        $('a').hover(function(){
            $(this).css({'color':'#FF6347'});
        }, function(){
            $(this).css({'color':'#B0C4DE'});
        });
    }
    function themeButton() {
        $('input[type=button],button').hover(function(){$(this).css({
            'color':'#0c2638',
            'box-shadow':'0px 0px 5px #123a55',
            '-moz-box-shadow':'0px 0px 5px #123a55',
            '-webkit-box-shadow':'0px 0px 5px #123a55',
            'text-shadow':'0px 0px 5px #123a55'
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
            'box-shadow':'inset 0px 0px 10px #1c5a85',
            '-moz-box-shadow':'inset 0px 0px 10px #1c5a85',
            '-webkit-box-shadow':'inset 0px 0px 10px #1c5a85'
        });});
        $(txt).blur(function(){$(this).css({
            'box-shadow':'inset 0px 0px 5px #1c5a85',
            '-moz-box-shadow':'inset 0px 0px 5px #1c5a85',
            '-webkit-box-shadow':'inset 0px 0px 5px #1c5a85'
        });});
    }
</script>