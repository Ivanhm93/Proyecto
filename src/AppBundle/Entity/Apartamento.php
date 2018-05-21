<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Apartamento
 *
 * @ORM\Table(name="apartamento", indexes={@ORM\Index(name="fk_Apartamento_Localidad1_idx", columns={"Localidad_id"}), @ORM\Index(name="fk_apartamento_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Apartamento
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
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @Assert\NotBlank()
     * @var integer
     *
     * @ORM\Column(name="Precio", type="integer", nullable=true)
     */
    private $precio;

    /**
     * @Assert\NotBlank()
     * @var integer
     *
     * @ORM\Column(name="Num_Personas", type="integer", nullable=true)
     */
    private $numPersonas;

    /**
     * @Assert\NotBlank()
     * @var integer
     *
     * @ORM\Column(name="Num_Habitaciones", type="integer", nullable=true)
     */
    private $numHabitaciones;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="Ubicacion", type="string", length=255, nullable=true)
     */
    private $ubicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @Assert\NotBlank()
     * @var \Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Localidad_id", referencedColumnName="id")
     * })
     */
    private $localidad;

    /**
     * @Assert\NotBlank()
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Apartamento
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
     * Set precio
     *
     * @param integer $precio
     *
     * @return Apartamento
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return integer
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set numPersonas
     *
     * @param integer $numPersonas
     *
     * @return Apartamento
     */
    public function setNumPersonas($numPersonas)
    {
        $this->numPersonas = $numPersonas;

        return $this;
    }

    /**
     * Get numPersonas
     *
     * @return integer
     */
    public function getNumPersonas()
    {
        return $this->numPersonas;
    }

    /**
     * Set numHabitaciones
     *
     * @param integer $numHabitaciones
     *
     * @return Apartamento
     */
    public function setNumHabitaciones($numHabitaciones)
    {
        $this->numHabitaciones = $numHabitaciones;

        return $this;
    }

    /**
     * Get numHabitaciones
     *
     * @return integer
     */
    public function getNumHabitaciones()
    {
        return $this->numHabitaciones;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Apartamento
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
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return Apartamento
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Apartamento
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Apartamento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set localidad
     *
     * @param \AppBundle\Entity\Localidad $localidad
     *
     * @return Apartamento
     */
    public function setLocalidad(\AppBundle\Entity\Localidad $localidad = null)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return \AppBundle\Entity\Localidad
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Apartamento
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
