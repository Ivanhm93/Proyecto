<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Alquiler
 *
 * @ORM\Table(name="alquiler", indexes={@ORM\Index(name="fk_Alquiler_Apartamento1_idx", columns={"Apartamento_id"}), @ORM\Index(name="fk_alquiler_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Alquiler
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
     * @ORM\Column(name="Fecha_Ini", type="string", length=10, nullable=true)
     */
    private $fechaIni;

    /**
     * @var string
     *
     * @ORM\Column(name="Fecha_Fin", type="string", length=10, nullable=true)
     */
    private $fechaFin;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="Apartamento_id", type="integer", nullable=false)
     */
    private $apartamentoId;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set fechaIni
     *
     * @param string $fechaIni
     *
     * @return Alquiler
     */
    public function setFechaIni($fechaIni)
    {
        $this->fechaIni = $fechaIni;

        return $this;
    }

    /**
     * Get fechaIni
     *
     * @return string
     */
    public function getFechaIni()
    {
        return $this->fechaIni;
    }

    /**
     * Set fechaFin
     *
     * @param string $fechaFin
     *
     * @return Alquiler
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return string
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Alquiler
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set apartamentoId
     *
     * @param integer $apartamentoId
     *
     * @return Alquiler
     */
    public function setApartamentoId($apartamentoId)
    {
        $this->apartamentoId = $apartamentoId;

        return $this;
    }

    /**
     * Get apartamentoId
     *
     * @return integer
     */
    public function getApartamentoId()
    {
        return $this->apartamentoId;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Alquiler
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString() {
		
		return $this->direccion;
	}
}
