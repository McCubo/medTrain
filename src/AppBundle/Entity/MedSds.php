<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedSds
 *
 * @ORM\Table(name="med_sds", indexes={@ORM\Index(name="idx_title_desc", columns={"sds_title"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MedSds
{
    /**
     * @var string
     *
     * @ORM\Column(name="sds_title", type="string", length=45, nullable=false)
     */
    private $sdsTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="sds_manufacturer", type="string", length=45, nullable=false)
     */
    private $sdsManufacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="sds_item_msds_num", type="string", length=10, nullable=false)
     */
    private $sdsItemMsdsNum;

    /**
     * @var string
     *
     * @ORM\Column(name="sds_file_name", type="string", length=150, nullable=false)
     */
    private $sdsFileName;

    /**
     * @var string
     *
     * @ORM\Column(name="sds_file_path", type="string", length=200, nullable=false)
     */
    private $sdsFilePath;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sds_created_at", type="datetime", nullable=false)
     */
    private $sdsCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sds_updated_at", type="datetime", nullable=true)
     */
    private $sdsUpdatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="sds_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sdsId;

    /**
     * @ORM\PrePersist
     */
    function setCreatedDate() {
        $this->sdsCreatedAt = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate
     */
    function setUpdatedDate() {
        $this->sdsUpdatedAt = new \DateTime();
    }
    
    function getSdsTitle() {
        return $this->sdsTitle;
    }

    function getSdsManufacturer() {
        return $this->sdsManufacturer;
    }

    function getSdsItemMsdsNum() {
        return $this->sdsItemMsdsNum;
    }

    function getSdsFileName() {
        return $this->sdsFileName;
    }

    function getSdsFilePath() {
        return $this->sdsFilePath;
    }

    function getSdsCreatedAt() {
        return $this->sdsCreatedAt;
    }

    function getSdsUpdatedAt() {
        return $this->sdsUpdatedAt;
    }

    function getSdsId() {
        return $this->sdsId;
    }

    function setSdsTitle($sdsTitle) {
        $this->sdsTitle = $sdsTitle;
    }

    function setSdsManufacturer($sdsManufacturer) {
        $this->sdsManufacturer = $sdsManufacturer;
    }

    function setSdsItemMsdsNum($sdsItemMsdsNum) {
        $this->sdsItemMsdsNum = $sdsItemMsdsNum;
    }

    function setSdsFileName($sdsFileName) {
        $this->sdsFileName = $sdsFileName;
    }

    function setSdsFilePath($sdsFilePath) {
        $this->sdsFilePath = $sdsFilePath;
    }

    function setSdsCreatedAt($sdsCreatedAt) {
        $this->sdsCreatedAt = $sdsCreatedAt;
    }

    function setSdsUpdatedAt($sdsUpdatedAt) {
        $this->sdsUpdatedAt = $sdsUpdatedAt;
    }

    function setSdsId($sdsId) {
        $this->sdsId = $sdsId;
    }

}
