<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localidad
 *
 * @ORM\Table(name="localidad", indexes={@ORM\Index(name="fk_Localidad_Provincia1_idx", columns={"Provincia_id"})})
 * @ORM\Entity
 */
class Localidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="Provincia_id", type="integer", nullable=false)
     */
    private $provinciaId;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Localidad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set provinciaId
     *
     * @param integer $provinciaId
     *
     * @return Localidad
     */
    public function setProvinciaId($provinciaId)
    {
        $this->provinciaId = $provinciaId;

        return $this;
    }

    /**
     * Get provinciaId
     *
     * @return integer
     */
    public function getProvinciaId()
    {
        return $this->provinciaId;
    }

    public function __toString() {

        return $this->nombre;
    }
}
