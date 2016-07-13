<?php
/**
 * Created by PhpStorm.
 * User: ilopez
 * Date: 7/13/16
 * Time: 13:52
 */

namespace Library;

/**
 * Class Resources.
 */
class Resources
{
    /**
     *
     */
    const BASE_FILE_NAME = 'base';
    /**
     *
     */
    const APPEND_SUFFIX_FILE_NAME = '-fix';
    /**
     *
     */
    const FILE_EXTENSION_SEPARATOR = '.';

    /**
     * @param $type
     * @param $root
     * @param $publicPath
     * @param $module
     * @param $controller
     * @param $action
     * @param $browser
     * @param $browserVersion
     * @param bool $appendFileModified
     *
     * @return array
     */
    public function getResources($type, $root, $publicPath, $module, $controller, $action, $browser, $browserVersion, $appendFileModified = true)
    {
        $resources = array();
        //** Find base type file **//
        $baseFilePath = APP_PATH.$root.self::BASE_FILE_NAME.'.'.$type;
        $baseType = file_exists($baseFilePath) ? self::BASE_FILE_NAME.'.'.$type : '';
        $baseTypeBrowserVersionFile = $this->getVersionFile(APP_PATH.$root, self::BASE_FILE_NAME.'_'.$browser.'_*.'.$type, $browserVersion);
        $baseTypeModified = '';
        $baseTypeFixModified = '';



        if (!is_null($baseTypeBrowserVersionFile)) {
            if ($baseTypeBrowserVersionFile['type'] == 'fix') {
                $baseTypeFix = self::BASE_FILE_NAME.'_'.$browser.'_'.$baseTypeBrowserVersionFile['version'].self::APPEND_SUFFIX_FILE_NAME.'.'.$type;
                $baseTypeFixModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$baseTypeFix) : '';
            } else {
                $baseType = self::BASE_FILE_NAME.'_'.$browser.'_'.$baseTypeBrowserVersionFile['version'].'.'.$type;
                $baseTypeModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$baseType) : '';
            }
        } else {
            $baseTypeModified = (!empty($baseType) && $appendFileModified) ? $this->versionFileModification($baseFilePath) : '';
        }


        $resources['baseTypeResource'] = !empty($baseType) ? $publicPath.$baseType.$baseTypeModified : '';
        $resources['baseTypeResourceFix'] = !empty($baseTypeFix) ? $publicPath.$baseTypeFix.$baseTypeFixModified : '';

        //** ********************** **//
        //** Find base module file **//
        $moduleBaseFilePath = APP_PATH.$root.$module.'/'.self::BASE_FILE_NAME.'.'.$type;
        $moduleBaseFile = file_exists($moduleBaseFilePath) ? self::BASE_FILE_NAME.'.'.$type : '';

        $baseModuleBrowserVersionFile = $this->getVersionFile(APP_PATH.$root.$module.'/', self::BASE_FILE_NAME.'_'.$browser.'_*.'.$type, $browserVersion);
        $baseModuleModified = '';
        $baseModuleFixModified = '';

        if (!is_null($baseModuleBrowserVersionFile)) {
            if ($baseModuleBrowserVersionFile['type'] == 'fix') {
                $moduleBaseFileFix = self::BASE_FILE_NAME.'_'.$browser.'_'.$baseModuleBrowserVersionFile['version'].self::APPEND_SUFFIX_FILE_NAME.'.'.$type;
                $baseModuleFixModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$module.'/'.$moduleBaseFileFix) : '';
            } else {
                $moduleBaseFile = self::BASE_FILE_NAME.'_'.$browser.'_'.$baseModuleBrowserVersionFile['version'].'.'.$type;
                $baseModuleModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$module.'/'.$moduleBaseFile) : '';
            }
        } else {
            $baseModuleModified = (!empty($moduleBaseFile) && $appendFileModified) ? $this->versionFileModification($moduleBaseFilePath) : '';
        }

        $resources['moduleBaseResource'] = !empty($moduleBaseFile) ? $publicPath.$module.'/'.$moduleBaseFile.$baseModuleModified : '';
        $resources['moduleBaseResourceFix'] = !empty($moduleBaseFileFix) ? $publicPath.$module.'/'.$moduleBaseFileFix.$baseModuleFixModified : '';

        //** ********************** **//
        //** Find base controller file **//
        $controllerBaseFilePath = APP_PATH.$root.$module.'/'.$controller.'/'.self::BASE_FILE_NAME.'.'.$type;
        $controllerBaseFile = file_exists($controllerBaseFilePath) ? self::BASE_FILE_NAME.'.'.$type : '';

        $baseControllerBrowserVersionFile = $this->getVersionFile(APP_PATH.$root.$module.'/'.$controller.'/', self::BASE_FILE_NAME.'_'.$browser.'_*.'.$type, $browserVersion);
        $baseControllerModified = '';
        $baseControllerFixModified = '';

        if (!is_null($baseControllerBrowserVersionFile)) {
            if ($baseModuleBrowserVersionFile['type'] == 'fix') {
                $controllerBaseFileFix = self::BASE_FILE_NAME.'_'.$browser.'_'.$baseControllerBrowserVersionFile['version'].self::APPEND_SUFFIX_FILE_NAME.'.'.$type;
                $baseControllerFixModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$module.'/'.$controller.'/'.$controllerBaseFileFix) : '';
            } else {
                $controllerBaseFile = self::BASE_FILE_NAME.'_'.$browser.'_'.$baseControllerBrowserVersionFile['version'].'.'.$type;
                $baseControllerModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$module.'/'.$controller.'/'.$controllerBaseFile) : '';
            }
        } else {
            $baseControllerModified = (!empty($controllerBaseFile) && $appendFileModified) ? $this->versionFileModification($controllerBaseFilePath) : '';
        }

        $resources['controllerBaseResource'] = !empty($controllerBaseFile) ? $publicPath.$module.'/'.$controller.'/'.$controllerBaseFile.$baseControllerModified : '';
        $resources['controllerBaseResourceFix'] = !empty($controllerBaseFileFix) ? $publicPath.$module.'/'.$controller.'/'.$controllerBaseFileFix.$baseControllerFixModified : '';

        //** ********************** **//
        //** Find action file **//
        $actionFilePath = APP_PATH.$root.$module.'/'.$controller.'/'.$action.'.'.$type;
        $actionFile = file_exists($actionFilePath) ? $action.'.'.$type : '';
        $actionBrowserVersionFile = $this->getVersionFile(APP_PATH.$root.$module.'/'.$controller.'/', $action.'_'.$browser.'_*.'.$type, $browserVersion);
        $actionModified = '';
        $actionFixModified = '';

        if (!is_null($actionBrowserVersionFile)) {
            if ($actionBrowserVersionFile['type'] == 'fix') {
                $actionFileFix = $action.'_'.$browser.'_'.$actionBrowserVersionFile['version'].self::APPEND_SUFFIX_FILE_NAME.'.'.$type;
                $actionFixModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$module.'/'.$controller.'/'.$actionFileFix) : '';
            } else {
                $actionFile = $action.'_'.$browser.'_'.$actionBrowserVersionFile['version'].'.'.$type;
                $actionModified = $appendFileModified ? $this->versionFileModification(APP_PATH.$root.$module.'/'.$controller.'/'.$actionFile) : '';
            }
        } else {
            $actionModified = (!empty($actionFile) && $appendFileModified) ? $this->versionFileModification($actionFilePath) : '';
        }

        $resources['actionResource'] = !empty($actionFile) ? $publicPath.$module.'/'.$controller.'/'.$actionFile.$actionModified : '';
        $resources['actionResourceFix'] = !empty($actionFileFix) ? $publicPath.$module.'/'.$controller.'/'.$actionFileFix.$actionFixModified : '';

        //** ********************** **//

        return $resources;
    }

    /**
     * @param $path
     * @param $fileType
     * @param $browserVersion
     *
     * @return array|string|void
     */
    private function getVersionFile($path, $fileType, $browserVersion)
    {
        if (!file_exists($path)) {
            return;
        }

        $extensionLenght = strpos($fileType, self::FILE_EXTENSION_SEPARATOR) - strlen($fileType);
        $versions = array();
        $maxLenght = 0;

        foreach (glob($path.$fileType) as $fileName) {



            $explodeFilename = explode('/', $fileName);


            $file = array_pop($explodeFilename);
            $type = 'override';


            if (strstr($file, self::APPEND_SUFFIX_FILE_NAME) !== false) {
                $type = 'fix';
                $file = str_replace(self::APPEND_SUFFIX_FILE_NAME, '', $file);
            }

            $arrayFile = explode('_', substr($file, 0, $extensionLenght));
            $explode   = array_pop($arrayFile);

            $versions[] = $explode;
            $lenght = count(explode('.', $explode));
            $maxLenght = $maxLenght < $lenght ? $lenght : $maxLenght;

        }


        if (count($versions) <= 0) {
            return;
        }


        $selectVersionInfo = $selectVersion = $this->selectVersion($versions, $maxLenght, $browserVersion);

        if (!is_null($selectVersion)) {
            $selectVersionInfo = array();
            $selectVersionInfo['version'] = $selectVersion;
            $selectVersionInfo['type'] = $type;
        }

        return $selectVersionInfo;
    }

    /**
     * @param $versions
     * @param $maxLenght
     * @param $browserVersion
     *
     * @return string|void
     */
    private function selectVersion($versions, $maxLenght, $browserVersion)
    {
        $lenght = count(explode('.', $browserVersion));
        $newVersions = array();

        foreach ($versions as $version) {
            if (count(explode('.', $version)) <= $maxLenght) {
                $newVersions[] = $version;
            }
        }

        if ($lenght > $maxLenght) {
            $browserVersionPieces = explode('.', $browserVersion);
            $browserVersionPieces = array_slice($browserVersionPieces, 0, $maxLenght - ($lenght + 1));
            $newBrowserVersion = implode('.', $browserVersionPieces).'.x';
        } else {
            $newBrowserVersion = $browserVersion;
        }

        if (array_search($newBrowserVersion, $newVersions, true) !== false) {
            return $newBrowserVersion;
        }

        if (array_search($newBrowserVersion.'.x', $newVersions, true) !== false) {
            return $newBrowserVersion.'.x';
        }

        $browserVersionPieces = explode('.', $newBrowserVersion);
        array_pop($browserVersionPieces);
        $newBrowserVersion = implode('.', $browserVersionPieces).'.x';

        if (array_search($newBrowserVersion, $newVersions, true) !== false) {
            return $newBrowserVersion;
        }

        $newMaxLenght = $maxLenght - 1;

        if ($newMaxLenght <= 1) {
            return;
        }

        return $this->selectVersion($newVersions, $newMaxLenght, $newBrowserVersion);
    }

    /**
     * @param $file
     *
     * @return string
     */
    private function versionFileModification($file)
    {
        return '?v='.date('Ymd', filemtime($file));
    }
}
