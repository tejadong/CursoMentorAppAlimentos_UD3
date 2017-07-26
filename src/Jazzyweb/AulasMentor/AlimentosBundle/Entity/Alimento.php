<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alimento
 *
 * @ORM\Table(name="alimento")
 * @ORM\Entity(repositoryClass="Jazzyweb\AulasMentor\AlimentosBundle\Repository\AlimentoRepository")
 */
class Alimento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var float
     *
     * @ORM\Column(name="energia", type="float")
     */
    private $energia;

    /**
     * @var float
     *
     * @ORM\Column(name="proteina", type="float")
     */
    private $proteina;

    /**
     * @var float
     *
     * @ORM\Column(name="hidratocarbono", type="float")
     */
    private $hidratocarbono;

    /**
     * @var float
     *
     * @ORM\Column(name="fibra", type="float")
     */
    private $fibra;

    /**
     * @var float
     *
     * @ORM\Column(name="grasatotal", type="float")
     */
    private $grasatotal;


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
     * @return Alimento
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
     * Set energia
     *
     * @param float $energia
     * @return Alimento
     */
    public function setEnergia($energia)
    {
        $this->energia = $energia;

        return $this;
    }

    /**
     * Get energia
     *
     * @return float 
     */
    public function getEnergia()
    {
        return $this->energia;
    }

    /**
     * Set proteina
     *
     * @param float $proteina
     * @return Alimento
     */
    public function setProteina($proteina)
    {
        $this->proteina = $proteina;

        return $this;
    }

    /**
     * Get proteina
     *
     * @return float 
     */
    public function getProteina()
    {
        return $this->proteina;
    }

    /**
     * Set hidratocarbono
     *
     * @param float $hidratocarbono
     * @return Alimento
     */
    public function setHidratocarbono($hidratocarbono)
    {
        $this->hidratocarbono = $hidratocarbono;

        return $this;
    }

    /**
     * Get hidratocarbono
     *
     * @return float 
     */
    public function getHidratocarbono()
    {
        return $this->hidratocarbono;
    }

    /**
     * Set fibra
     *
     * @param float $fibra
     * @return Alimento
     */
    public function setFibra($fibra)
    {
        $this->fibra = $fibra;

        return $this;
    }

    /**
     * Get fibra
     *
     * @return float 
     */
    public function getFibra()
    {
        return $this->fibra;
    }

    /**
     * Set grasatotal
     *
     * @param float $grasatotal
     * @return Alimento
     */
    public function setGrasatotal($grasatotal)
    {
        $this->grasatotal = $grasatotal;

        return $this;
    }

    /**
     * Get grasatotal
     *
     * @return float 
     */
    public function getGrasatotal()
    {
        return $this->grasatotal;
    }
}
