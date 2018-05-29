<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comentario
 *
 * @ORM\Table(name="comentario", indexes={@ORM\Index(name="fk_comentario_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_comentario_apartamento1_idx", columns={"apartamento_id"})})
 * @ORM\Entity
 */
class Comentario
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
     * @ORM\Column(name="Fecha", type="string", length=10, nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Texto", type="string", length=255, nullable=true)
     */
    private $texto;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=45, nullable=true)
     */
    private $apellidos;

    /**
     * @var \Apartamento
     *
     * @ORM\ManyToOne(targetEntity="Apartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="apartamento_id", referencedColumnName="id")
     * })
     */
    private $apartamento;

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
     * Set fecha
     *
     * @param string $fecha
     *
     * @return Comentario
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Comentario
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Comentario
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Comentario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set apartamento
     *
     * @param \AppBundle\Entity\Apartamento $apartamento
     *
     * @return Comentario
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Comentario
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
		
		return $this->texto;
	}
}
