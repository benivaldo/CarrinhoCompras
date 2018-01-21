<?php

namespace Pedido\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

/**
 * Pedido
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="pedidos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pedido\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cliente_id", type="integer", nullable=false)
     */
    private $clienteId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="date", nullable=false)
     */
    private $dateCreate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    protected $inputFilter;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clienteId.
     *
     * @param int $clienteId
     *
     * @return Pedido
     */
    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    /**
     * Get clienteId.
     *
     * @return int
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }

    /**
     * Set dateCreate.
     *
     * @param \DateTime|null $dateCreate
     *
     * @return Pedido
     */
    public function setDateCreate($dateCreate = null)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate.
     *
     * @return \DateTime|null
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }
    
    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Pedidos
     */
    public function setStatus($status)
    {
        $this->status = $status;
        
        return $this;
    }
    
    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->dateCreate = new \DateTime(date('Y-m-d'));

    }
    
    public function exchangeArray($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = (!empty($value) ? $value: null);
        }
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
}
