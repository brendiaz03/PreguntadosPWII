<?php
    include_once("controller/PartidaController.php");
    include_once("model/PartidaModel.php");
    include_once("controller/AdminController.php");
    include_once("model/AdminModel.php");
    include_once ("controller/UsuarioController.php");
    include_once ("model/UsuarioModel.php");
    include_once("helper/Conexion_db.php");
    include_once ("helper/Presenter.php");
    include_once ("helper/MustachePresenter.php");
    include_once ("helper/Router.php");

    include_once('vendor/mustache/src/Mustache/Autoloader.php');
    class Configuration
    {
        public static function getUsuarioController()
        {
            return new UsuarioController(self::getUsuarioModel(), self::getPresenter());

        }
        private static function getUsuarioModel()
        {
            return new UsuarioModel(self::getDatabase());
        }
        public static function getAdminController()
        {
            return new AdminController(self::getAdminModel(), self::getPresenter());

        }
        private static function getAdminModel()
        {
            return new AdminModel(self::getDatabase());
        }
        public static function getPartidaController()
        {
            return new PartidaController(self::getPartidaModel(), self::getPresenter());

        }
        private static function getPartidaModel()
        {
            return new PartidaModel(self::getDatabase());
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
            return new Router("getPartidaController", "get");
        }
        private static function getPresenter()
        {
            return new MustachePresenter("view/template");
        }
    }
?>
