<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoItens
 *
 * @ORM\Table(name="pedido_itens", indexes={@ORM\Index(name="pedido_id", columns={"pedido_id"})})
 * @ORM\Entity
 */
class PedidoItens
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_item", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @var \Pedidos
     *
     * @ORM\ManyToOne(targetEntity="Pedidos")
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
    public function getIdItem()
    {
        return $this->idItem;
    }

    /**
     * Set codigo.
     *
     * @param string $codigo
     *
     * @return PedidoItens
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
     * @return PedidoItens
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
     * @return PedidoItens
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
     * @return PedidoItens
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
     * @param \Pedidos|null $pedido
     *
     * @return PedidoItens
     */
    public function setPedido(\Pedidos $pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido.
     *
     * @return \Pedidos|null
     */
    public function getPedido()
    {
        return $this->pedido;
    }
}
