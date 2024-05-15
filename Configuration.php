<?php
    include_once ("controller/PokemonController.php");
    include_once ("model/PokemonModel.php");
    include_once("helper/Conexion_db.php");
    include_once ("helper/Presenter.php");
    include_once ("helper/MustachePresenter.php");
    include_once ("helper/Router.php");

    include_once('vendor/mustache/src/Mustache/Autoloader.php');
    class Configuration
    {
        public static function getPokemonController()
        {
            return new PokemonController(self::getPokemonModel(), self::getPresenter());

        }
        private static function getPokemonModel()
        {
            return new PokemonModel(self::getDatabase());
        }
        public static function getDatabase()
        {
            $config = self::getConfig();
            return new Database($config["servername"], $config["username"], $config["password"], $config["database"]);
        }
        private static function getConfig()
        {
            return parse_ini_file("config/db.ini");
        }
        public static function getRouter()
        {
            return new Router("getPokemonController", "get");
        }
        private static function getPresenter()
        {
            return new MustachePresenter("view/template");
        }
    }
?>
