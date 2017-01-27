<?php

class Component {
    private $folderName;
    private $dirPath;
    private $description;
    private $implementations = array();
    private $cssFiles        = array();
    private $errors          = array();

    function __construct($folderName) {
        $this->folderName = $folderName;
        $this->dirPath    = CITY_COMPONENTS_FOLDER . DIRECTORY_SEPARATOR . $folderName;

        if (! is_dir($this->dirPath)) {
            throw new ComponentNotFoundException("Component $folderName doesn't exist!");
        }

        $this->init();
    }

    function getName() {
        return $this->folderName;
    }

    function getPath() {
        return $this->dirPath;
    }

    function getUrl() {
        return '/' . $this->folderName;
    }

    function getDescription() {
        return $this->description;
    }

    function getImplementations() {
        return $this->implementations;
    }

    function getCSSFiles() {
        return $this->cssFiles;
    }

    function getErrors() {
        return $this->errors;
    }

    function getImplementationByUrl($url) {
        foreach($this->getImplementations() as $imp):
            if ($imp->getUrl() == $url) return $imp;
        endforeach;

        throw new ImplementationNotFoundException("Implementation for url $url doesn't exist!");
    }

    function init() {
        $files = scandir($this->dirPath);

        foreach($files as $file) {
            if (startsWith($file, '.')) {
                continue;
            }

            if (endsWith($file, '.css')) {
                array_push($this->cssFiles, '/components/' . $this->folderName . '/' . $file);
                continue;
            }

            if (endsWith($file, '.html')) {
                array_push($this->implementations, new Implementation($this, $file));
                continue;
            }

            if ($file == 'description.txt') {
                $this->description = file_get_contents($this->dirPath . DIRECTORY_SEPARATOR . $file);
                continue;
            }

            $msg = "File '$file' is unnecessary. Please, remove it.";
            array_push($this->errors, $msg);
        }

        if (empty($this->description)) {
            $msg = "File 'description.txt' is missing.";
            array_push($this->errors, $msg);
        }
    }
}

/**
 * An implementation of one component
 */
class Implementation {
    private $file;
    private $component;

    function __construct($component, $file) {
        $this->component = $component;
        $this->file      = $file;
    }

    function getId() {
        $id = explode('.', $file);
        return $id[0];
    }

    function getUrl() {
        return $this->component->getUrl() . '/' . $this->file;
    }

    function getName() {
        return $this->file;
    }

    function getContent() {
        return file_get_contents($this->getPath());
    }

    function getPath() {
        return $this->component->getPath() . DIRECTORY_SEPARATOR . $this->file;
    }
}


/** Exceptions */

class ComponentNotFoundException extends Exception {}
class ImplementationNotFoundException extends Exception {}
?>
