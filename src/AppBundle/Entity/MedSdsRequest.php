<?php

namespace AppBundle\Entity;

/**
 *
 * @author cubias
 */
class MedSdsRequest {

    private $id;
    private $title;
    private $manufacturer;
    private $item_msds_num;
    private $file_name;

    function populateObject($medObject) {
        $this->setFile_name($medObject->getSdsFileName());
        $this->setId($medObject->getSdsId());
        $this->setTitle($medObject->getSdsManufacturer());
        $this->setManufacturer($medObject->getSdsManufacturer());
        $this->setItem_msds_num($medObject->getSdsItemMsdsNum());
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getTitle() {
        return $this->title;
    }

    function getManufacturer() {
        return $this->manufacturer;
    }

    function getItem_msds_num() {
        return $this->item_msds_num;
    }

    function getFile_name() {
        return $this->file_name;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setManufacturer($manufacturer) {
        $this->manufacturer = $manufacturer;
    }

    function setItem_msds_num($item_msds_num) {
        $this->item_msds_num = $item_msds_num;
    }

    function setFile_name($file_name) {
        $this->file_name = $file_name;
    }

}
