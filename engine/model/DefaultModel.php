<?php

class DefaultModel extends Model {
    
    public $tables=array();
    public $core=array();
    
    public function generateConfigData() {
        if(!file_exists(Engine::path("config_engine"))) {
            $file=fopen(Engine::path("config_engine"), "w");
            $data='<?xml version="1.0" encoding="utf-8"?><config>
                <database>
                        <host></host>
                        <port>3306</port>
                        <username>root</username>
                        <password></password>
                        <name>nuggets</name>
                        <prefix>nugget_</prefix>
                </database>
                <mail>
                        <host></host>
                        <port></port>
                        <username></username>
                        <password></password>
                        <sender></sender>
                </mail></config>';
            fwrite($file, $data);
            fclose($file);
        }
        if(!file_exists(Engine::path("config_site"))) {
            $file=fopen(Engine::path("config_site"), "w");
            $data='<?xml version="1.0" encoding="utf-8"?><config>
                <site>
                        <title></title>
                        <header></header>
                        <moto></moto>
                        <footer></footer>
                        <domain></domain>
                </site></config>';
            fwrite($file, $data);
            fclose($file);
        }
        Config::loadEngineConfig();
        Config::loadSiteConfig();
        $this->setData("database", Config::getDataSet("database"));
        $this->setData("mail", Config::getDataSet("mail"));
        $this->setData("site", Config::getDataSet("site"));
    }
    
    public function saveConfig($params) {
        $dom=new DOMDocument();
        $dom->load(Engine::path("config_engine"));
        $xml=simplexml_import_dom($dom);
        $keys=array_keys($params);
        $db=$xml->database;
        foreach($keys as $k) {
            if(strpos($k, "db_")==0) {
                $field=substr($k,3);
                $db->$field=$params[$k];
            }
        }
        $dom=new DOMDocument();
        $dom->preserveWhiteSpace=false;
        $dom->formatOutput=true;
        $dom->loadXML($xml->asXML());
        $dom->save(Engine::path("config_engine"));
        $dom=new DOMDocument();
        $dom->load(Engine::path("config_site"));
        $xml=simplexml_import_dom($dom);
        $keys=array_keys($params);
        $db=$xml->site;
        foreach($keys as $k) {
            if(strpos($k, "st_")==0) {
                $field=substr($k,3);
                $db->$field=$params[$k];
            }
        }
        $dom=new DOMDocument();
        $dom->preserveWhiteSpace=false;
        $dom->formatOutput=true;
        $dom->loadXML($xml->asXML());
        $dom->save(Engine::path("config_site"));
        return TRUE;
    }
}

?>
