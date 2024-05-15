<?php
    include_once ("controller/PokemonController.php");
    include_once ("model/PokemonModel.php");
    include_once("helper/Conexion_db.php");
    include_once ("helper/Presenter.php");
    include_once ("helper/MustachePresenter.php");
<<<<<<< HEAD
    include_once ("helper/Router.php");
=======
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61

    include_once('vendor/mustache/src/Mustache/Autoloader.php');
    class Configuration
    {

        public static function getPokemonController()
        {
<<<<<<< HEAD
            return new PokemonController(self::getPokemonModel(), self::getPresenter());
=======
            return new PokemonController(self::getPresenter());
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
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
<<<<<<< HEAD
            return new Database($config["servername"], $config["username"], $config["password"], $config["database"]);
=======
            return new Database($config["servername"], $config["username"], $config["password"], $config["dbname"]);
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
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
