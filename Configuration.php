<?php
    include_once ("controller/PokemonController.php");
    include_once ("model/PokemonModel.php");
    include_once("helper/Conexion_db.php");
    include_once ("helper/Presenter.php");
    include_once ("helper/MustachePresenter.php");

    include_once('vendor/mustache/src/Mustache/Autoloader.php');
    class Configuration
    {

        public static function getPokemonController()
        {
            return new PokemonController(self::getPresenter());
        }

        // MODELS
        private static function getPokemonModel()
        {
            return new PokemonModel(self::getDatabase());
        }


        // HELPERS
        public static function getDatabase()
        {
            $config = self::getConfig();
            return new Database($config["servername"], $config["username"], $config["password"], $config["dbname"]);
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
