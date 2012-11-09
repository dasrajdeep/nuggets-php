<style>
    
body {
    background-color:#1c5a85;
    color:#ebedee;
    font-family:Arial, Helvetica, sans-serif;
    margin:0px;
    padding:0px;
    min-height:100%;
}

a {
    text-decoration:none;
    color:#B0C4DE;
    cursor:pointer;
}

img {
    margin: 5px;
}

button,input[type=button],input[type=submit],input[type=reset] {
    padding:5px;
    margin:5px;
    width:150px;
    height:30px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    color:#1c5a85;
    <?php echo CSSHelper::getGradient('ebedee', 'a7a7a7'); ?>
}

span {
    margin:5px;
    padding:5px;
    border-radius:5px;
}

input[type=text],input[type=password] {
    padding:5px;
    margin:5px;
    width:150px;
    height:20px;
    border:none;
    border-radius:5px;
    background-color:#efefef;
    color:#2c7cb4;
    <?php echo CSSHelper::getShadow(0, 0, 5, '1c5a85', TRUE); ?>
}

textarea {
    font-family:Arial, Helvetica, sans-serif;
    padding:5px;
    margin:5px;
    width:250px;
    height:50px;
    border:none;
    border-radius:5px;
    background-color:#efefef;
    color:#2c7cb4;
    <?php echo CSSHelper::getShadow(0, 0, 5, '1c5a85', TRUE); ?>
}

table.themed {
    background-color:#c8c8c8;
    border-radius:5px;
}

th {
    padding:5px;
    background-color:#ebedee;
    color:#1c5a85;
}

td {
    padding: 5px;
}

footer {
    text-align:center;
    width:100%;
    background-color:#ebedee;
    color:#555555;
    margin-top:25px;
    padding:10px;
    font-style:italic;
    <?php echo CSSHelper::getShadow(0, 0, 5, '555555', TRUE); ?>
}

hr {
    color:#1c5a85;
    background-color:#1c5a85;
    border:none;
}

.right_align {
    text-align:right;
}

.config_fields {
    border-radius:5px;
    padding:10px;
    <?php 
    echo CSSHelper::getGradient('3093c7', '123a55');
    echo CSSHelper::getShadow(0, 0, 5, '0c2638');
    ?>
}

.separator {
    margin:10px;
    padding:0px;
    height:1px;
    width:100%;
    background-color:#ebedee;
}

#navigation_bar {
    position:fixed;
    left:0px;
    top:0px;
    width:100%;
    height:55px;
    
    <?php
        echo CSSHelper::getGradient('ebedee', 'c3c5c6');
        echo CSSHelper::getShadow(0, 5, 5, '123a55',FALSE);
    ?>
}

#header {
        background-color:#ebedee;
        color:#1c5a85;
        border-radius:5px;
        padding:10px;
        margin:5px;
}

#msg0 {
    font-size:36px;
    font-style:bold;
}
#msg0 span {
    position:relative;
    bottom:40px;
}
#msg0 img {
    width: 100px;
    height: 100px;
}

#msg1 {
    background-color:#FA8072;
    font-size:24px;
    font-style:bold;
}
#msg1 span {
    position:relative;
    bottom:20px;
}
#msg1 img {
    width: 50px;
    height: 50px;
}

</style>