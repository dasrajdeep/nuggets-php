<style>
/*Elements*/
body {
    font-family:Arial, Helvetica, sans-serif;
    background-color:#232323;
    color:#c8c8c8;
    margin:0px;
    padding:0px;
}

a {
    text-decoration:none;
    color:#1E90FF;
}

button,input[type=button],input[type=submit],input[type=reset] {
    width:150px;
    height:30px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    color:#232323;
    <?php echo CSSHelper::getGradient('c8c8c8', '808080'); ?>
}

div {
    padding:5px;
}

img {
}

span {
    padding:5px;
}

td {
}

input[type=text],input[type=password] {
    padding:5px;
    width:150px;
    height:20px;
    border:none;
    border-radius:5px;
    background-color:#e9e9e9;
    color:#808080;
    <?php echo CSSHelper::getShadow(0, 0, 5, 232323, TRUE); ?>
}

textarea {
    font-family:Arial, Helvetica, sans-serif;
    padding:5px;
    width:250px;
    height:50px;
    border:none;
    border-radius:5px;
    background-color:#e9e9e9;
    color:#808080;
    <?php echo CSSHelper::getShadow(0, 0, 5, 232323, TRUE); ?>
}

th {
    background-color:#c8c8c8;
    color:#232323;
    border-radius:3px;
}

/*Classes*/
.separator {
    margin:10px;
    padding:0px;
    height:1px;
    width:100%;
    background-color:#c8c8c8;
}

/*Identifiers*/
#navigation_bar {
    position:fixed;
    left:0px;
    top:0px;
    width:100%;
    height:40px;
    
    <?php
        echo CSSHelper::getGradient('e8e8e8', 'c8c8c8');
        echo CSSHelper::getShadow(0, 5, 5, '030303',FALSE);
    ?>
}

#header {
    background-color:#c8c8c8;
    color:#232323;
    border-radius:5px;
    padding:10px;
    margin:5px;
}

#footer {
    color:#c8c8c8;
    padding:10px;
    font-style:italic;
}

</style>