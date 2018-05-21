<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Foto
 *
 * @ORM\Table(name="foto", indexes={@ORM\Index(name="fk_Foto_Apartamento1_idx", columns={"Apartamento_id"})})
 * @ORM\Entity
 */
class Foto
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
     * @ORM\Column(name="Imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @Assert\NotBlank()
     * @var \Apartamento
     *
     * @ORM\ManyToOne(targetEntity="Apartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Apartamento_id", referencedColumnName="id")
     * })
     */
    private $apartamento;



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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Foto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set apartamento
     *
     * @param \AppBundle\Entity\Apartamento $apartamento
     *
     * @return Foto
     */
    public function setApartamento(\AppBundle\Entity\Apartamento $apartamento = null)
    {
        $this->apartamento = $apartamento;

        return $this;
    }

    /**
     * Get apartamento
     *
     * @return \AppBundle\Entity\Apartamento
     */
    public function getApartamento()
    {
        return $this->apartamento;
    }
}
