<?php

namespace PedidoItem\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;


/**
 * PedidoItem
 *
 * @ORM\Table(name="pedido_itens", indexes={@ORM\Index(name="pedido_id", columns={"pedido_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="PedidoItem\Repository\PedidoItemRepository")
 */
class PedidoItem
{
    protected $inputFilter;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id_item", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $idItem;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=false)
     */
    private $codigo;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $total;

    /**
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido\Entity\Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id", referencedColumnName="id")
     * })
     */
    private $pedido;



     /**
     * Get idItem.
     *
     * @return int
     */
    public function getId()
    {
        return $this->idItem;
    }

    /**
     * Set codigo.
     *
     * @param string $codigo
     *
     * @return PedidoItem
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo.
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set quantidade.
     *
     * @param int $quantidade
     *
     * @return PedidoItem
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade.
     *
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set valor.
     *
     * @param string $valor
     *
     * @return PedidoItem
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set total.
     *
     * @param string $total
     *
     * @return PedidoItem
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total.
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set pedido.
     *
     * @param \Pedidos $pedido
     *
     * @return PedidoItem
     */
    public function setPedido(\Pedido\Entity\Pedido $pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido.
     *
     * @return \Pedidos
     */
    public function getPedido()
    {
        return $this->pedido;
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
