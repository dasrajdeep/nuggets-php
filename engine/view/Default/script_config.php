<script type="text/javascript">
    $(document).ready(function(){
        $('input[name=save]').click(saveConfig);
    });
    function saveConfig() {
        var query=new Array();
        var cnt=0;
        $('#database_config').find('input[type=text]').each(function(){
            query[cnt++]="db_"+$(this).attr('name')+"="+$(this).val();
        });
        $('#site_config').find('input[type=text]').each(function(){
            query[cnt++]="st_"+$(this).attr('name')+"="+$(this).val();
        });
        post("saveconfig",query,"loader_config_save",function(data){
            if(data=="success") $('#notification').html("Configuration saved.");
            else $('#notification').html("Configuration could not be saved!");
        });
    }
</script>